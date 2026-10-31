<?php

namespace Tests\Feature;

use App\Models\Admin;
use Database\Seeders\AdminAuthSeeder;
use Database\Seeders\BusinessSettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_root_route_displays_the_admin_login_form(): void
    {
        config(['services.admin_login_captcha_enabled' => false]);
        $this->seed(BusinessSettingSeeder::class);

        $this->get('/')
            ->assertOk()
            ->assertSee('action="'.route('login').'"', false)
            ->assertSee('name="role" id="role" value="admin"', false)
            ->assertSee('name="email"', false)
            ->assertSee('name="password"', false)
            ->assertDontSee('assets/back-end/js/vendor.min.js')
            ->assertDontSee('assets/back-end/js/toastr.js')
            ->assertDontSee('/storage/company')
            ->assertDontSee('name="default_captcha_value"', false)
            ->assertDontSee('g-recaptcha-response');
    }

    public function test_admin_can_login_without_captcha_when_login_captcha_is_disabled(): void
    {
        config(['services.admin_login_captcha_enabled' => false]);
        $this->seed([BusinessSettingSeeder::class, AdminAuthSeeder::class]);

        $this->post(route('login'), [
            'role' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '12345678',
        ])->assertRedirect(route('admin.dashboard'));

        $this->get(route('admin.dashboard'))->assertOk();
    }

    public function test_an_authenticated_admin_is_redirected_from_root_to_dashboard(): void
    {
        $this->actingAs(new Admin(), 'admin')
            ->get('/')
            ->assertRedirect(route('admin.dashboard'));
    }

    public function test_admin_dashboard_requires_admin_authentication(): void
    {
        $this->get('/admin/dashboard')->assertNotFound();
    }

    public function test_authenticated_admin_can_open_the_dashboard(): void
    {
        $this->actingAs(new Admin(), 'admin')
            ->get('/admin/dashboard')
            ->assertOk()
            ->assertSee('Good morning, Farhad')
            ->assertSee('Recent orders')
            ->assertSee(route('admin.dashboard'), false);
    }
}
