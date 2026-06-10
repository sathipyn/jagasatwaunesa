<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_the_login_page(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
    }

    public function test_public_users_can_not_visit_the_admin_dashboard(): void
    {
        $this->actingAs($user = User::factory()->create());

        $this->get('/admin')->assertForbidden();
    }

    public function test_public_dashboard_route_is_not_registered(): void
    {
        $this->get('/dashboard')->assertNotFound();
    }
}
