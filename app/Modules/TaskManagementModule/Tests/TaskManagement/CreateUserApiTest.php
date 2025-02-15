<?php

namespace Tests\Feature\UserManagement;

use App\Modules\SharedModule\Auth\DataBaseSeeders\RolesPermissionsSeeder;
use App\Modules\SharedModule\Auth\Models\User;
use App\Modules\SharedModule\UserManagement\Models\AddUpdateUserDto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateUserApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed roles and permissions
        $this->seed(RolesPermissionsSeeder::class);
    }

    public function test_create_user_requires_authentication(): void
    {
        $this->postJson('/api/users/create', [])
            ->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']);
    }

    public function test_create_user_requires_proper_permission(): void
    {
        $user = \App\Modules\SharedModule\UserManagement\DataBase\Factories\UserFactory::new()->create()->assignRole('employee');
        $this->actingAs($user);
        $this->postJson('/api/users/create', [])->assertStatus(200);
    }

    public function test_create_user_successfully(): void
    {
        $admin = \App\Modules\SharedModule\UserManagement\DataBase\Factories\UserFactory::new()->create()->assignRole('admin');
        $this->actingAs($admin);

        $dto = new AddUpdateUserDto([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
        ]);

        $this->postJson('/api/users/create', $dto->toArray())
            ->assertStatus(200)
            ->assertJson(['status' => true, 'message' => __('shared.success')]);

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);
    }


    public function test_create_user_fails_due_to_invalid_data_name_column(): void
    {
        $admin = \App\Modules\SharedModule\UserManagement\DataBase\Factories\UserFactory::new()->create()->assignRole('admin');
        $this->actingAs($admin);

        $this->postJson('/api/users/create', [
            'name' => '',
            'email' => 'valid-email',
            'password' => '123',
        ])->assertStatus(200)
        ->assertJson(['status' => false, 'message' => __('auth.name_required')]);
    }


    public function test_create_user_fails_due_to_invalid_data_password_column(): void
    {
        $admin = \App\Modules\SharedModule\UserManagement\DataBase\Factories\UserFactory::new()->create()->assignRole('admin');
        $this->actingAs($admin);

        $this->postJson('/api/users/create', [
            'name' => 'ali',
            'email' => 'valid-email',
            'password' => '12312',
        ])->assertStatus(200)
        ->assertJson(['status' => false, 'message' => __('auth.password_min')]);
    }


    public function test_create_user_fails_due_to_invalid_data_email_column(): void
    {
        $admin = \App\Modules\SharedModule\UserManagement\DataBase\Factories\UserFactory::new()
        ->create([
            'name' => 'ali',
            'email' => 'email@.com',
            'password' => '12312@pro',
        ])->assignRole('admin');
        $this->actingAs($admin);


        $this->postJson('/api/users/create', [
            'name' => 'ali',
            'email' => 'email@.com',
            'password' => '1231@2',
        ])->assertStatus(200)
        ->assertJson(['status' => false, 'message' => __('auth.email_unique')]);
    }



}
