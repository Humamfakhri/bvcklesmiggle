<?php

namespace Tests\Feature;

use App\Models\ArticleCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class AdminOptionalFieldSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_valid_admin_forms_accept_optional_fields_as_nullable(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create([
            'username' => 'adminuser_' . Str::random(6),
            'email' => 'admin_' . Str::random(6) . '@example.com',
            'is_admin' => true,
        ]);

        ArticleCategory::create(['name' => 'News']);

        $this->actingAs($admin);

        $this->post(route('admin-products.store'), [
            'name' => 'Test Product',
            'category' => 'Accessories',
            'linkShopee' => null,
            'linkTokopedia' => null,
            'productImage' => [
                UploadedFile::fake()->image('product.jpg', 800, 600)->size(120),
            ],
            'issue' => '<p>Product issue description that is long enough for validation.</p>',
            'details' => '<p>Detailed product information with specifications and features.</p>',
        ])->assertRedirect(route('admin-products'));

        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'link_shopee' => null,
            'link_tokopedia' => null,
        ]);

        $this->post(route('admin-articles.store'), [
            'title' => 'Test Article',
            'author' => 'Admin Writer',
            'category' => 'News',
            'body' => '<p>Valid article content with enough detail for the admin form.</p>',
        ])->assertRedirect(route('admin-articles'));

        $this->assertDatabaseHas('articles', [
            'title' => 'Test Article',
            'image' => null,
        ]);

        $this->post(route('admin-partnerships.store'), [
            'name' => 'Partner Name',
            'image' => UploadedFile::fake()->image('partner.jpg', 600, 600)->size(100),
            'link' => null,
        ])->assertRedirect(route('admin-partnerships'));

        $this->assertDatabaseHas('partnerships', [
            'name' => 'Partner Name',
            'link' => null,
        ]);

        $this->post(route('admin-downloads.store'), [
            'title' => 'Download Guide',
            'link' => 'https://example.com/download.pdf',
        ])->assertRedirect(route('admin-downloads'));

        $this->assertDatabaseHas('downloads', [
            'title' => 'Download Guide',
            'link' => 'https://example.com/download.pdf',
        ]);
    }
}
