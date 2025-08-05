<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApotekSystemTest extends TestCase
{
    use RefreshDatabase;

    public function test_welcome_page_loads(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        // Just check if the page loads successfully
    }

    public function test_dashboard_requires_authentication(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }

    public function test_seeded_data_exists(): void
    {
        $this->seed();

        $this->assertDatabaseHas('roles', ['name' => 'superadmin']);
        $this->assertDatabaseHas('roles', ['name' => 'admin']);
        $this->assertDatabaseHas('roles', ['name' => 'user']);
        
        $this->assertDatabaseHas('users', ['email' => 'superadmin@apotek.com']);
        $this->assertDatabaseHas('pharmacy_settings', ['name' => 'Apotek Sehat Bersama']);
        
        $this->assertTrue(\App\Models\Category::count() > 0);
        $this->assertTrue(\App\Models\Unit::count() > 0);
        $this->assertTrue(\App\Models\Distributor::count() > 0);
        $this->assertTrue(\App\Models\Product::count() > 0);
    }

    public function test_user_permissions_work(): void
    {
        $this->seed();

        $superadmin = User::where('email', 'superadmin@apotek.com')->first();
        $admin = User::where('email', 'admin@apotek.com')->first();
        $user = User::where('email', 'kasir1@apotek.com')->first();

        // Superadmin should have system.audit permission
        $this->assertTrue($superadmin->hasPermission('system.audit'));
        
        // Admin should have sales.create permission
        $this->assertTrue($admin->hasPermission('sales.create'));
        
        // Regular user should have sales.create but not system.audit
        $this->assertTrue($user->hasPermission('sales.create'));
        $this->assertFalse($user->hasPermission('system.audit'));
    }
}