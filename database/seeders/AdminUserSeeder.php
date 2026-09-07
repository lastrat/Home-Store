<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Home Store',
            'email' => 'admin@homestore.ci',
            'phone' => '+2250700000000',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
            'phone_verified_at' => now(),
        ]);
    }
}
