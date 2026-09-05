<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SecurityHardeningTest extends TestCase
{
    use RefreshDatabase;

    public function test_non_admin_user_is_redirected_from_admin_routes(): void
    {
        $user = User::factory()->create([
            'is_admin' => false,
        ]);

        $this->actingAs($user)
            ->get('/admin/articles')
            ->assertRedirect('/');
    }

    public function test_sanitizer_removes_javascript_from_rich_text(): void
    {
        $clean = \App\Support\HtmlSanitizer::sanitize('<script>alert(1)</script><p>Hello <strong>world</strong></p>');

        $this->assertStringNotContainsString('<script>', $clean);
        $this->assertStringContainsString('<p>Hello <strong>world</strong></p>', $clean);
    }
}
