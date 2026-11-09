<?php

namespace Tests\Feature\Admin\Customer;

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\ModulePermissionMiddleware;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CustomerControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_customer_creation_stores_the_uploaded_profile_image(): void
    {
        Storage::fake('public');
        $this->withoutMiddleware([AdminMiddleware::class, ModulePermissionMiddleware::class]);

        $response = $this->post(route('admin.customer.add'), [
            'name' => 'Taylor Customer',
            'email' => 'taylor@example.test',
            'phone' => '+8801700000001',
            'password' => 'customer-password',
            'image' => UploadedFile::fake()->image('customer.png'),
        ]);

        $response->assertRedirect(route('admin.customer.list'));

        $customer = User::query()->where('email', 'taylor@example.test')->firstOrFail();

        $this->assertDatabaseHas('users', [
            'id' => $customer->id,
            'image' => $customer->image,
        ]);
        Storage::disk('public')->assertExists('profile/'.$customer->image);
        $this->assertSame('webp', pathinfo($customer->image, PATHINFO_EXTENSION));
    }

    public function test_replacing_a_customer_image_deletes_the_previous_file(): void
    {
        Storage::fake('public');
        $this->withoutMiddleware([AdminMiddleware::class, ModulePermissionMiddleware::class]);
        Storage::disk('public')->put('profile/previous.webp', 'previous image');
        $customer = $this->createCustomer(image: 'previous.webp');

        $response = $this->post(route('admin.customer.update', $customer->id), [
            'name' => $customer->name,
            'email' => $customer->email,
            'phone' => $customer->phone,
            'image' => UploadedFile::fake()->image('replacement.png'),
        ]);

        $response->assertRedirect(route('admin.customer.list'));

        $customer->refresh();
        $this->assertNotSame('previous.webp', $customer->image);
        Storage::disk('public')->assertMissing('profile/previous.webp');
        Storage::disk('public')->assertExists('profile/'.$customer->image);
    }

    public function test_updating_without_a_new_image_keeps_the_existing_profile_image(): void
    {
        Storage::fake('public');
        $this->withoutMiddleware([AdminMiddleware::class, ModulePermissionMiddleware::class]);
        Storage::disk('public')->put('profile/kept.webp', 'existing image');
        $customer = $this->createCustomer(image: 'kept.webp');

        $response = $this->post(route('admin.customer.update', $customer->id), [
            'name' => 'Updated Customer',
            'email' => $customer->email,
            'phone' => $customer->phone,
        ]);

        $response->assertRedirect(route('admin.customer.list'));

        $customer->refresh();
        $this->assertSame('kept.webp', $customer->image);
        Storage::disk('public')->assertExists('profile/kept.webp');
    }

    public function test_deleting_a_customer_also_deletes_the_profile_image(): void
    {
        Storage::fake('public');
        $this->withoutMiddleware([AdminMiddleware::class, ModulePermissionMiddleware::class]);
        Storage::disk('public')->put('profile/deleted.webp', 'customer image');
        $customer = $this->createCustomer(image: 'deleted.webp');

        $response = $this->delete(route('admin.customer.delete', $customer->id));

        $response->assertRedirect();
        $this->assertDatabaseMissing('users', ['id' => $customer->id]);
        Storage::disk('public')->assertMissing('profile/deleted.webp');
    }

    public function test_customer_status_can_be_updated_without_oauth_tables(): void
    {
        $this->withoutMiddleware([AdminMiddleware::class, ModulePermissionMiddleware::class]);
        $customer = $this->createCustomer(image: '');

        $response = $this->postJson(route('admin.customer.status-update'), [
            'id' => $customer->id,
            'status' => 0,
        ]);

        $response->assertOk()
            ->assertJsonPath('message', translate('update_successfully'));
        $this->assertDatabaseHas('users', [
            'id' => $customer->id,
            'is_active' => 0,
        ]);
    }

    public function test_customer_creation_rejects_non_image_uploads(): void
    {
        Storage::fake('public');
        $this->withoutMiddleware([AdminMiddleware::class, ModulePermissionMiddleware::class]);

        $response = $this->from(route('admin.customer.add'))->post(route('admin.customer.add'), [
            'name' => 'Taylor Customer',
            'email' => 'taylor@example.test',
            'phone' => '+8801700000001',
            'password' => 'customer-password',
            'image' => UploadedFile::fake()->create('notes.txt', 10, 'text/plain'),
        ]);

        $response->assertRedirect(route('admin.customer.add'));
        $response->assertSessionHasErrors('image');
        $this->assertDatabaseMissing('users', ['email' => 'taylor@example.test']);
        $this->assertSame([], Storage::disk('public')->allFiles());
    }

    private function createCustomer(string $image): User
    {
        return User::query()->create([
            'name' => 'Existing Customer',
            'email' => 'existing@example.test',
            'phone' => '+8801700000002',
            'password' => 'customer-password',
            'is_active' => true,
            'image' => $image,
        ]);
    }
}
