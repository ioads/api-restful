<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'role' => 'user',
                'name' => 'user',
                'email' => 'user@teste.com',
                'password' => Hash::make('secret'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role' => 'admin',
                'name' => 'admin',
                'email' => 'admin@teste.com',
                'password' => Hash::make('secret'),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
