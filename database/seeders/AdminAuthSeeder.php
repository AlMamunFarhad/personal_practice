<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\AdminRole;
use Illuminate\Support\Facades\Hash;

class AdminAuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  public function run(): void
    {
        AdminRole::updateOrCreate(
            ['id' => 1],
            ['name' => 'Master Admin', 'status' => 1]
        );

        AdminRole::updateOrCreate(
            ['id' => 2],
            ['name' => 'Employee', 'status' => 1]
        );

        Admin::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Master Admin',
                'phone' => '01700000000',
                'email' => 'admin@gmail.com',
                'admin_role_id' => 1,
                'image' => 'def.png',
                'password' => Hash::make('12345678'),
                'status' => 1,
            ]
        );
    }
}
