<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Emerlon Magdua',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'mobile' => '1234567890',
            'gender' => 'male',
            'role' => 'admin',
        ]);

    }
}
