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

class AdminCrudFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_update_and_delete_all_dashboard_models(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create([
            'username' => 'admincrud_' . Str::random(6),
            'email' => 'admincrud_' . Str::random(6) . '@example.com',
            'is_admin' => true,
        ]);

        $this->actingAs($admin);

        ArticleCategory::create(['name' => 'News']);
        ProductCategory::create(['name' => 'Accessories']);

        $this->post('/admin/articles', [
            'title' => 'Test Article',
            'author' => 'Admin Writer',
            'category' => 'News',
            'body' => '<p>Valid article content with enough detail for the admin form.</p>',
        ])->assertRedirect('/admin/articles');

        $article = Article::query()->first();
        $this->assertNotNull($article);

        $this->put('/admin/articles/' . $article->id, [
            'titleEdit' => 'Updated Article',
            'authorEdit' => 'Updated Author',
            'categoryEdit' => 'News',
            'bodyEdit' => '<p>Updated article content that is long enough for validation.</p>',
        ])->assertRedirect('/admin/articles');

        $this->assertDatabaseHas('articles', ['title' => 'Updated Article']);

        $this->post('/admin/products', [
            'name' => 'Test Product',
            'category' => 'Accessories',
            'linkShopee' => null,
            'linkTokopedia' => null,
            'productImage' => [
                UploadedFile::fake()->image('product.jpg', 800, 600)->size(120),
            ],
            'issue' => '<p>Product issue description that is long enough for validation.</p>',
            'details' => '<p>Detailed product information with specifications and features.</p>',
        ])->assertRedirect('/admin/products');

        $product = Product::query()->first();
        $this->assertNotNull($product);

        $this->put('/admin/products/' . $product->id, [
            'nameEdit' => 'Updated Product',
            'categoryEdit' => 'Accessories',
            'linkShopeeEdit' => null,
            'linkTokopediaEdit' => null,
            'productImageEdit' => [
                UploadedFile::fake()->image('updated-product.jpg', 800, 600)->size(120),
            ],
            'issueEdit' => '<p>Updated product issue description with enough detail.</p>',
            'detailsEdit' => '<p>Updated product details with more technical information.</p>',
        ])->assertRedirect('/admin/products');

        $this->assertDatabaseHas('products', ['name' => 'Updated Product']);

        $this->post('/admin/partnership', [
            'name' => 'Partner Name',
            'link' => null,
            'image' => UploadedFile::fake()->image('partner.jpg', 600, 600)->size(120),
        ])->assertRedirect('/admin/partnership');

        $partnership = Partnership::query()->first();
        $this->assertNotNull($partnership);

        $this->put('/admin/partnership/' . $partnership->id, [
            'nameEdit' => 'Updated Partner',
            'linkEdit' => null,
            'imageEdit' => UploadedFile::fake()->image('updated-partner.jpg', 600, 600)->size(120),
        ])->assertRedirect('/admin/partnership');

        $this->assertDatabaseHas('partnerships', ['name' => 'Updated Partner']);

        $this->post('/admin/downloads', [
            'title' => 'Download Guide',
            'link' => 'https://example.com/download.pdf',
        ])->assertRedirect('/admin/downloads');

        $download = Download::query()->first();
        $this->assertNotNull($download);

        $this->put('/admin/downloads/' . $download->id, [
            'titleEdit' => 'Updated Download Guide',
            'linkEdit' => 'https://example.com/updated-download.pdf',
        ])->assertRedirect('/admin/downloads');

        $this->assertDatabaseHas('downloads', ['title' => 'Updated Download Guide']);

        $this->delete('/admin/articles/' . $article->id)->assertRedirect('/admin/articles');
        $this->delete('/admin/products/' . $product->id)->assertRedirect('/admin/products');
        $this->delete('/admin/partnership/' . $partnership->id)->assertRedirect('/admin/partnership');
        $this->delete('/admin/downloads/' . $download->id)->assertRedirect('/admin/downloads');

        $this->assertDatabaseMissing('articles', ['id' => $article->id]);
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
        $this->assertDatabaseMissing('partnerships', ['id' => $partnership->id]);
        $this->assertDatabaseMissing('downloads', ['id' => $download->id]);
    }
}
