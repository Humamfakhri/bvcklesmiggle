<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Download;
use App\Models\Partnership;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * Comprehensive admin dashboard CRUD tests.
 *
 * Covers: Articles, Article Categories, Products, Product Categories,
 *         Partnerships, Downloads, and Users.
 */
class AdminDashboardCrudTest extends TestCase
{
    use RefreshDatabase;

    // ─── Helpers ──────────────────────────────────────────────────────────────

    private function makeAdmin(): User
    {
        return User::factory()->create([
            'name'     => 'Admin User',
            'username' => 'admin_' . Str::random(6),
            'email'    => 'admin_' . Str::random(6) . '@example.com',
            'is_admin' => true,
        ]);
    }

    private function makeRegularUser(): User
    {
        return User::factory()->create([
            'name'     => 'Regular User',
            'username' => 'user_' . Str::random(6),
            'email'    => 'user_' . Str::random(6) . '@example.com',
            'is_admin' => false,
        ]);
    }

    // ─── Access Control ───────────────────────────────────────────────────────

    /** @test */
    public function guest_cannot_access_any_admin_route(): void
    {
        $routes = [
            ['GET',    '/admin/articles'],
            ['GET',    '/admin/products'],
            ['GET',    '/admin/partnership'],
            ['GET',    '/admin/downloads'],
            ['GET',    '/admin/users'],
        ];

        foreach ($routes as [$method, $uri]) {
            $response = $this->call($method, $uri);
            $response->assertRedirect('/');
        }
    }

    /** @test */
    public function non_admin_user_cannot_access_admin_routes(): void
    {
        $user = $this->makeRegularUser();
        $this->actingAs($user);

        $routes = [
            ['GET',    '/admin/articles'],
            ['GET',    '/admin/products'],
            ['GET',    '/admin/partnership'],
            ['GET',    '/admin/downloads'],
            ['GET',    '/admin/users'],
        ];

        foreach ($routes as [$method, $uri]) {
            $this->call($method, $uri)->assertRedirect('/');
        }
    }

    /** @test */
    public function admin_can_access_all_dashboard_index_pages(): void
    {
        $this->actingAs($this->makeAdmin());

        $this->get('/admin/articles')->assertOk();
        $this->get('/admin/products')->assertOk();
        $this->get('/admin/partnership')->assertOk();
        $this->get('/admin/downloads')->assertOk();
        $this->get('/admin/users')->assertOk();
    }

    // ─── Articles ─────────────────────────────────────────────────────────────

    /** @test */
    public function admin_can_create_an_article(): void
    {
        Storage::fake('public');
        $this->actingAs($this->makeAdmin());

        ArticleCategory::create(['name' => 'Tech']);

        $this->post('/admin/articles', [
            'title'    => 'My First Article',
            'author'   => 'John Doe',
            'category' => 'Tech',
            'body'     => '<p>This is a well-written article body with sufficient content.</p>',
        ])->assertRedirect('/admin/articles');

        $this->assertDatabaseHas('articles', [
            'title'  => 'My First Article',
            'author' => 'John Doe',
            'slug'   => 'my-first-article',
        ]);

        $this->assertDatabaseHas('article_with_categories', [
            'article_id'  => Article::first()->id,
            'category_id' => ArticleCategory::where('name', 'Tech')->first()->id,
        ]);
    }

    /** @test */
    public function admin_can_create_an_article_with_an_image(): void
    {
        Storage::fake('public');
        $this->actingAs($this->makeAdmin());

        ArticleCategory::create(['name' => 'Tech']);

        $this->post('/admin/articles', [
            'title'        => 'Article With Image',
            'author'       => 'Jane Doe',
            'category'     => 'Tech',
            'articleImage' => UploadedFile::fake()->image('hero.jpg', 800, 400)->size(100),
            'body'         => '<p>Article body with an image attached for hero display.</p>',
        ])->assertRedirect('/admin/articles');

        $article = Article::where('title', 'Article With Image')->first();
        $this->assertNotNull($article->image);
        Storage::disk('public')->assertExists($article->image);
    }

    /** @test */
    public function admin_can_update_an_article(): void
    {
        Storage::fake('public');
        $this->actingAs($this->makeAdmin());

        $category = ArticleCategory::create(['name' => 'Tech']);
        $article  = Article::create([
            'title'      => 'Original Title',
            'pure_title' => 'Original Title',
            'slug'       => 'original-title',
            'author'     => 'Author One',
            'body'       => 'Original body content.',
        ]);

        $this->put('/admin/articles/' . $article->id, [
            'titleEdit'    => 'Updated Article Title',
            'authorEdit'   => 'Author Two',
            'categoryEdit' => 'Tech',
            'bodyEdit'     => '<p>Updated body that is long enough to pass the min:20 validation rule.</p>',
        ])->assertRedirect('/admin/articles');

        $this->assertDatabaseHas('articles', [
            'id'    => $article->id,
            'title' => 'Updated Article Title',
            'slug'  => 'updated-article-title',
        ]);
    }

    /** @test */
    public function admin_can_delete_an_article(): void
    {
        $this->actingAs($this->makeAdmin());

        $article = Article::create([
            'title'      => 'To Delete',
            'pure_title' => 'To Delete',
            'slug'       => 'to-delete',
            'author'     => 'Author',
            'body'       => 'Body text.',
        ]);

        $this->delete('/admin/articles/' . $article->id)
            ->assertRedirect('/admin/articles');

        $this->assertDatabaseMissing('articles', ['id' => $article->id]);
    }

    /** @test */
    public function admin_can_add_image_when_updating_article_that_had_no_image(): void
    {
        Storage::fake('public');
        $this->actingAs($this->makeAdmin());

        $category = ArticleCategory::create(['name' => 'Tech']);

        // Article created without an image
        $article = Article::create([
            'title'      => 'No Image Article',
            'pure_title' => 'No Image Article',
            'slug'       => 'no-image-article',
            'author'     => 'Author',
            'image'      => null,
            'body'       => 'Original body.',
        ]);

        $this->assertNull($article->image);

        // Update it, attaching an image for the first time
        $this->put('/admin/articles/' . $article->id, [
            'titleEdit'        => 'No Image Article',
            'authorEdit'       => 'Author',
            'categoryEdit'     => 'Tech',
            'articleImageEdit' => UploadedFile::fake()->image('new.jpg', 800, 600)->size(100),
            'bodyEdit'         => '<p>Updated body that is long enough to pass the min:20 validation rule.</p>',
        ])->assertRedirect('/admin/articles');

        $article->refresh();
        $this->assertNotNull($article->image);
        Storage::disk('public')->assertExists($article->image);
    }

    /** @test */
    public function deleting_article_removes_associated_image_from_storage(): void
    {
        Storage::fake('public');
        $this->actingAs($this->makeAdmin());

        $imagePath = 'article_images/test.jpg';
        Storage::disk('public')->put($imagePath, 'fake-content');

        $article = Article::create([
            'title'      => 'Img Article',
            'pure_title' => 'Img Article',
            'slug'       => 'img-article',
            'author'     => 'Author',
            'image'      => $imagePath,
            'body'       => 'Body.',
        ]);

        $this->delete('/admin/articles/' . $article->id);

        Storage::disk('public')->assertMissing($imagePath);
    }

    /** @test */
    public function admin_can_create_an_article_category(): void
    {
        $this->actingAs($this->makeAdmin());

        $this->post('/admin/articles', [
            'name' => 'Science',
        ])->assertRedirect('/admin/articles');

        $this->assertDatabaseHas('article_categories', ['name' => 'Science']);
    }

    /** @test */
    public function article_store_validation_rejects_short_title(): void
    {
        $this->actingAs($this->makeAdmin());
        ArticleCategory::create(['name' => 'Tech']);

        $this->post('/admin/articles', [
            'title'    => 'Hi',   // min:3 — too short
            'author'   => 'Author',
            'category' => 'Tech',
            'body'     => '<p>This body is long enough to pass validation checks here.</p>',
        ])->assertSessionHasErrors('title');
    }

    /** @test */
    public function article_store_validation_rejects_short_body(): void
    {
        $this->actingAs($this->makeAdmin());
        ArticleCategory::create(['name' => 'Tech']);

        $this->post('/admin/articles', [
            'title'    => 'Valid Title',
            'author'   => 'Author',
            'category' => 'Tech',
            'body'     => 'Too short',  // min:20
        ])->assertSessionHasErrors('body');
    }

    // ─── Products ─────────────────────────────────────────────────────────────

    /** @test */
    public function admin_can_create_a_product(): void
    {
        Storage::fake('public');
        $this->actingAs($this->makeAdmin());

        $this->post('/admin/products', [
            'name'          => 'Awesome Widget',
            'category'      => 'Electronics',
            'linkShopee'    => null,
            'linkTokopedia' => null,
            'productImage'  => [
                UploadedFile::fake()->image('widget.jpg', 800, 600)->size(100),
            ],
            'issue'   => '<p>This widget solves a common everyday problem for users.</p>',
            'details' => '<p>Made of premium materials with a two-year warranty included.</p>',
        ])->assertRedirect('/admin/products');

        $this->assertDatabaseHas('products', ['name' => 'Awesome Widget']);

        $product = Product::where('name', 'Awesome Widget')->first();
        $images  = json_decode($product->product_images, true);
        $this->assertCount(1, $images);
        Storage::disk('public')->assertExists($images[0]);
    }

    /** @test */
    public function admin_can_create_a_product_with_shopee_and_tokopedia_links(): void
    {
        Storage::fake('public');
        $this->actingAs($this->makeAdmin());

        $this->post('/admin/products', [
            'name'          => 'Linked Widget',
            'category'      => 'Electronics',
            'linkShopee'    => 'https://shopee.co.id/product/123',
            'linkTokopedia' => 'https://www.tokopedia.com/store/product',
            'productImage'  => [
                UploadedFile::fake()->image('linked.jpg', 800, 600)->size(100),
            ],
            'issue'   => '<p>Solves the problem of tracking deliveries across platforms.</p>',
            'details' => '<p>Compatible with all major marketplaces and shipping providers.</p>',
        ])->assertRedirect('/admin/products');

        $this->assertDatabaseHas('products', [
            'name'          => 'Linked Widget',
            'link_shopee'   => 'https://shopee.co.id/product/123',
            'link_tokopedia' => 'https://www.tokopedia.com/store/product',
        ]);
    }

    /** @test */
    public function admin_can_update_a_product(): void
    {
        Storage::fake('public');
        $this->actingAs($this->makeAdmin());

        $product = Product::create([
            'name'           => 'Old Product',
            'category'       => 'Old Cat',
            'product_images' => json_encode([]),
            'issue'          => 'Original issue description text.',
            'details'        => 'Original details description text.',
        ]);

        $this->put('/admin/products/' . $product->id, [
            'nameEdit'            => 'New Product Name',
            'categoryEdit'        => 'New Category',
            'linkShopeeEdit'      => null,
            'linkTokopediaEdit'   => null,
            'issueEdit'           => '<p>Updated issue description that meets the minimum length.</p>',
            'detailsEdit'         => '<p>Updated details description with additional product info.</p>',
        ])->assertRedirect('/admin/products');

        $this->assertDatabaseHas('products', [
            'id'   => $product->id,
            'name' => 'New Product Name',
        ]);
    }

    /** @test */
    public function admin_can_update_product_images(): void
    {
        Storage::fake('public');
        $this->actingAs($this->makeAdmin());

        $oldImagePath = 'product_images/old.jpg';
        Storage::disk('public')->put($oldImagePath, 'old-image');

        $product = Product::create([
            'name'           => 'Image Product',
            'category'       => 'Cat',
            'product_images' => json_encode([$oldImagePath]),
            'issue'          => 'Issue text for this product.',
            'details'        => 'Detail text for this product.',
        ]);

        $this->put('/admin/products/' . $product->id, [
            'nameEdit'          => 'Image Product',
            'categoryEdit'      => 'Cat',
            'productImageEdit'  => [
                UploadedFile::fake()->image('new.jpg', 800, 600)->size(100),
            ],
            'issueEdit'   => '<p>Updated issue description that meets the minimum length.</p>',
            'detailsEdit' => '<p>Updated details description with additional info.</p>',
        ])->assertRedirect('/admin/products');

        Storage::disk('public')->assertMissing($oldImagePath);

        $product->refresh();
        $newImages = json_decode($product->product_images, true);
        $this->assertCount(1, $newImages);
        Storage::disk('public')->assertExists($newImages[0]);
    }

    /** @test */
    public function admin_can_delete_a_product(): void
    {
        Storage::fake('public');
        $this->actingAs($this->makeAdmin());

        $product = Product::create([
            'name'           => 'Deletable',
            'category'       => 'Cat',
            'product_images' => json_encode([]),
            'issue'          => 'Issue text.',
            'details'        => 'Details text.',
        ]);

        $this->delete('/admin/products/' . $product->id)
            ->assertRedirect('/admin/products');

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    /** @test */
    public function admin_can_create_a_product_category(): void
    {
        $this->actingAs($this->makeAdmin());

        $this->post('/admin/products', [
            'categoryName' => 'Accessories',
        ])->assertRedirect('/admin/products');

        $this->assertDatabaseHas('product_categories', ['name' => 'Accessories']);
    }

    /** @test */
    public function product_store_requires_at_least_one_image(): void
    {
        $this->actingAs($this->makeAdmin());

        $this->post('/admin/products', [
            'name'     => 'No Image Product',
            'category' => 'Cat',
            'issue'    => '<p>Issue description that meets the minimum length requirement.</p>',
            'details'  => '<p>Details description that meets the minimum length requirement.</p>',
            // productImage deliberately omitted
        ])->assertSessionHasErrors('productImage');
    }

    // ─── Partnerships ─────────────────────────────────────────────────────────

    /** @test */
    public function admin_can_create_a_partnership(): void
    {
        Storage::fake('public');
        $this->actingAs($this->makeAdmin());

        $this->post('/admin/partnership', [
            'name'  => 'Acme Corp',
            'image' => UploadedFile::fake()->image('acme.jpg', 400, 400)->size(50),
            'link'  => 'https://acme.example.com',
        ])->assertRedirect('/admin/partnership');

        $this->assertDatabaseHas('partnerships', [
            'name' => 'Acme Corp',
            'link' => 'https://acme.example.com',
        ]);

        $partnership = Partnership::where('name', 'Acme Corp')->first();
        Storage::disk('public')->assertExists($partnership->image);
    }

    /** @test */
    public function admin_can_create_a_partnership_without_link(): void
    {
        Storage::fake('public');
        $this->actingAs($this->makeAdmin());

        $this->post('/admin/partnership', [
            'name'  => 'Silent Partner',
            'image' => UploadedFile::fake()->image('silent.jpg', 400, 400)->size(50),
            'link'  => null,
        ])->assertRedirect('/admin/partnership');

        $this->assertDatabaseHas('partnerships', [
            'name' => 'Silent Partner',
            'link' => null,
        ]);
    }

    /** @test */
    public function admin_can_update_a_partnership(): void
    {
        Storage::fake('public');
        $this->actingAs($this->makeAdmin());

        $imagePath = 'partnership_images/old.jpg';
        Storage::disk('public')->put($imagePath, 'old-content');

        $partnership = Partnership::create([
            'name'  => 'Old Partner',
            'image' => $imagePath,
            'link'  => null,
        ]);

        $this->put('/admin/partnership/' . $partnership->id, [
            'nameEdit' => 'New Partner Name',
            'linkEdit' => 'https://newpartner.example.com',
        ])->assertRedirect('/admin/partnership');

        $this->assertDatabaseHas('partnerships', [
            'id'   => $partnership->id,
            'name' => 'New Partner Name',
            'link' => 'https://newpartner.example.com',
        ]);
    }

    /** @test */
    public function admin_can_update_partnership_image(): void
    {
        Storage::fake('public');
        $this->actingAs($this->makeAdmin());

        $oldImagePath = 'partnership_images/old.jpg';
        Storage::disk('public')->put($oldImagePath, 'old-content');

        $partnership = Partnership::create([
            'name'  => 'Partner',
            'image' => $oldImagePath,
            'link'  => null,
        ]);

        $this->put('/admin/partnership/' . $partnership->id, [
            'nameEdit'  => 'Partner',
            'imageEdit' => UploadedFile::fake()->image('new-logo.png', 400, 400)->size(50),
            'linkEdit'  => null,
        ])->assertRedirect('/admin/partnership');

        Storage::disk('public')->assertMissing($oldImagePath);

        $partnership->refresh();
        Storage::disk('public')->assertExists($partnership->image);
    }

    /** @test */
    public function admin_can_delete_a_partnership(): void
    {
        Storage::fake('public');
        $this->actingAs($this->makeAdmin());

        $imagePath = 'partnership_images/del.jpg';
        Storage::disk('public')->put($imagePath, 'content');

        $partnership = Partnership::create([
            'name'  => 'Delete Me',
            'image' => $imagePath,
            'link'  => null,
        ]);

        $this->delete('/admin/partnership/' . $partnership->id)
            ->assertRedirect('/admin/partnership');

        $this->assertDatabaseMissing('partnerships', ['id' => $partnership->id]);
        Storage::disk('public')->assertMissing($imagePath);
    }

    /** @test */
    public function partnership_store_requires_an_image(): void
    {
        $this->actingAs($this->makeAdmin());

        $this->post('/admin/partnership', [
            'name' => 'No Image Partner',
            'link' => null,
            // image deliberately omitted
        ])->assertSessionHasErrors('image');
    }

    /** @test */
    public function partnership_store_rejects_invalid_url(): void
    {
        Storage::fake('public');
        $this->actingAs($this->makeAdmin());

        $this->post('/admin/partnership', [
            'name'  => 'Bad URL Partner',
            'image' => UploadedFile::fake()->image('logo.jpg', 400, 400)->size(50),
            'link'  => 'not-a-valid-url',
        ])->assertSessionHasErrors('link');
    }

    // ─── Downloads ────────────────────────────────────────────────────────────

    /** @test */
    public function admin_can_create_a_download(): void
    {
        $this->actingAs($this->makeAdmin());

        $this->post('/admin/downloads', [
            'title' => 'User Manual v1.0',
            'link'  => 'https://example.com/manual.pdf',
        ])->assertRedirect('/admin/downloads');

        $this->assertDatabaseHas('downloads', [
            'title' => 'User Manual v1.0',
            'link'  => 'https://example.com/manual.pdf',
        ]);
    }

    /** @test */
    public function admin_can_update_a_download(): void
    {
        $this->actingAs($this->makeAdmin());

        $download = Download::create([
            'title' => 'Old Manual',
            'link'  => 'https://example.com/old.pdf',
        ]);

        $this->put('/admin/downloads/' . $download->id, [
            'titleEdit' => 'New Manual v2.0',
            'linkEdit'  => 'https://example.com/new.pdf',
        ])->assertRedirect('/admin/downloads');

        $this->assertDatabaseHas('downloads', [
            'id'    => $download->id,
            'title' => 'New Manual v2.0',
            'link'  => 'https://example.com/new.pdf',
        ]);
    }

    /** @test */
    public function admin_can_delete_a_download(): void
    {
        $this->actingAs($this->makeAdmin());

        $download = Download::create([
            'title' => 'Deletable Doc',
            'link'  => 'https://example.com/doc.pdf',
        ]);

        $this->delete('/admin/downloads/' . $download->id)
            ->assertRedirect('/admin/downloads');

        $this->assertDatabaseMissing('downloads', ['id' => $download->id]);
    }

    /** @test */
    public function download_store_requires_a_valid_url(): void
    {
        $this->actingAs($this->makeAdmin());

        $this->post('/admin/downloads', [
            'title' => 'Bad Link Doc',
            'link'  => 'not-a-url',
        ])->assertSessionHasErrors('link');
    }

    /** @test */
    public function download_store_requires_title_of_at_least_3_chars(): void
    {
        $this->actingAs($this->makeAdmin());

        $this->post('/admin/downloads', [
            'title' => 'Hi',
            'link'  => 'https://example.com/doc.pdf',
        ])->assertSessionHasErrors('title');
    }

    /** @test */
    public function download_update_requires_a_valid_url(): void
    {
        $this->actingAs($this->makeAdmin());

        $download = Download::create([
            'title' => 'Good Doc',
            'link'  => 'https://example.com/doc.pdf',
        ]);

        $this->put('/admin/downloads/' . $download->id, [
            'titleEdit' => 'Good Doc Updated',
            'linkEdit'  => 'bad-url',
        ])->assertSessionHasErrors('linkEdit');
    }

    // ─── Users ────────────────────────────────────────────────────────────────

    /** @test */
    public function admin_can_view_user_list(): void
    {
        $this->actingAs($this->makeAdmin());

        $regular = $this->makeRegularUser();

        $this->get('/admin/users')
            ->assertOk()
            ->assertSee($regular->name);
    }

    /** @test */
    public function admin_can_create_a_user(): void
    {
        $this->actingAs($this->makeAdmin());

        $this->post('/admin/users', [
            'name'                  => 'Jane Regular',
            'username'              => 'janeregular',
            'email'                 => 'jane@example.com',
            'password'              => 'secret123',
            'password_confirmation' => 'secret123',
        ])->assertRedirect(route('admin-users.index'));

        $this->assertDatabaseHas('users', [
            'email'    => 'jane@example.com',
            'is_admin' => false,
        ]);
    }

    /** @test */
    public function admin_can_delete_a_regular_user(): void
    {
        $this->actingAs($this->makeAdmin());

        $user = $this->makeRegularUser();

        $this->delete('/admin/users/' . $user->id)
            ->assertRedirect(route('admin-users.index'));

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    /** @test */
    public function admin_cannot_delete_another_admin_user(): void
    {
        $admin        = $this->makeAdmin();
        $anotherAdmin = $this->makeAdmin();

        $this->actingAs($admin);

        $this->delete('/admin/users/' . $anotherAdmin->id)
            ->assertRedirect(route('admin-users.index'))
            ->assertSessionHas('error');

        $this->assertDatabaseHas('users', ['id' => $anotherAdmin->id]);
    }

    /** @test */
    public function user_store_requires_unique_email(): void
    {
        $this->actingAs($this->makeAdmin());

        $existing = $this->makeRegularUser();

        $this->post('/admin/users', [
            'name'                  => 'Duplicate',
            'username'              => 'unique_user_' . Str::random(5),
            'email'                 => $existing->email,
            'password'              => 'secret123',
            'password_confirmation' => 'secret123',
        ])->assertSessionHasErrors('email');
    }

    /** @test */
    public function user_store_requires_password_confirmation(): void
    {
        $this->actingAs($this->makeAdmin());

        $this->post('/admin/users', [
            'name'                  => 'Mismatch User',
            'username'              => 'mismatch_' . Str::random(5),
            'email'                 => 'mismatch@example.com',
            'password'              => 'secret123',
            'password_confirmation' => 'different456',
        ])->assertSessionHasErrors('password');
    }

    // ─── Full Flow: Create → Update → Delete ──────────────────────────────────

    /** @test */
    public function full_crud_flow_for_all_admin_models(): void
    {
        Storage::fake('public');
        $admin = $this->makeAdmin();
        $this->actingAs($admin);

        // ── Article ──
        ArticleCategory::create(['name' => 'General']);

        $this->post('/admin/articles', [
            'title'    => 'Flow Article',
            'author'   => 'Flow Author',
            'category' => 'General',
            'body'     => '<p>Full flow article body with enough characters to pass validation.</p>',
        ])->assertRedirect('/admin/articles');

        $article = Article::where('title', 'Flow Article')->firstOrFail();

        $this->put('/admin/articles/' . $article->id, [
            'titleEdit'    => 'Flow Article Updated',
            'authorEdit'   => 'Flow Author Updated',
            'categoryEdit' => 'General',
            'bodyEdit'     => '<p>Updated flow article body with enough characters for validation.</p>',
        ])->assertRedirect('/admin/articles');

        $this->assertDatabaseHas('articles', ['title' => 'Flow Article Updated']);

        $this->delete('/admin/articles/' . $article->id)
            ->assertRedirect('/admin/articles');

        $this->assertDatabaseMissing('articles', ['id' => $article->id]);

        // ── Product ──
        $this->post('/admin/products', [
            'name'          => 'Flow Product',
            'category'      => 'General',
            'linkShopee'    => null,
            'linkTokopedia' => null,
            'productImage'  => [
                UploadedFile::fake()->image('prod.jpg', 800, 600)->size(100),
            ],
            'issue'   => '<p>Flow product issue description that is long enough to pass validation.</p>',
            'details' => '<p>Flow product detail description that is long enough to pass validation.</p>',
        ])->assertRedirect('/admin/products');

        $product = Product::where('name', 'Flow Product')->firstOrFail();

        $this->put('/admin/products/' . $product->id, [
            'nameEdit'          => 'Flow Product Updated',
            'categoryEdit'      => 'General',
            'linkShopeeEdit'    => null,
            'linkTokopediaEdit' => null,
            'issueEdit'         => '<p>Updated issue description that is long enough to pass validation.</p>',
            'detailsEdit'       => '<p>Updated detail description that is long enough to pass validation.</p>',
        ])->assertRedirect('/admin/products');

        $this->assertDatabaseHas('products', ['name' => 'Flow Product Updated']);

        $this->delete('/admin/products/' . $product->id)
            ->assertRedirect('/admin/products');

        $this->assertDatabaseMissing('products', ['id' => $product->id]);

        // ── Partnership ──
        $this->post('/admin/partnership', [
            'name'  => 'Flow Partner',
            'image' => UploadedFile::fake()->image('partner.jpg', 400, 400)->size(50),
            'link'  => null,
        ])->assertRedirect('/admin/partnership');

        $partnership = Partnership::where('name', 'Flow Partner')->firstOrFail();

        $this->put('/admin/partnership/' . $partnership->id, [
            'nameEdit' => 'Flow Partner Updated',
            'linkEdit' => null,
        ])->assertRedirect('/admin/partnership');

        $this->assertDatabaseHas('partnerships', ['name' => 'Flow Partner Updated']);

        $this->delete('/admin/partnership/' . $partnership->id)
            ->assertRedirect('/admin/partnership');

        $this->assertDatabaseMissing('partnerships', ['id' => $partnership->id]);

        // ── Download ──
        $this->post('/admin/downloads', [
            'title' => 'Flow Manual',
            'link'  => 'https://example.com/flow-manual.pdf',
        ])->assertRedirect('/admin/downloads');

        $download = Download::where('title', 'Flow Manual')->firstOrFail();

        $this->put('/admin/downloads/' . $download->id, [
            'titleEdit' => 'Flow Manual Updated',
            'linkEdit'  => 'https://example.com/flow-manual-v2.pdf',
        ])->assertRedirect('/admin/downloads');

        $this->assertDatabaseHas('downloads', ['title' => 'Flow Manual Updated']);

        $this->delete('/admin/downloads/' . $download->id)
            ->assertRedirect('/admin/downloads');

        $this->assertDatabaseMissing('downloads', ['id' => $download->id]);
    }
}
