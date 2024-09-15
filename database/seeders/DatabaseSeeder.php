<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'Admin',
             'email' => 'admin@gmail.com',
             'is_Admin' => 1,
             'password' => 'password',
             'number' => 23232323

         ]);

         \App\Models\User::factory()->create([
            'name' => 'agent',
            'email' => 'agent@gmail.com',
            'is_Admin' => 2,
            'password' => 'password',
            'number' => 23232323

        ]);

        \App\Models\User::factory()->create([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'is_Admin' => 0,
            'password' => 'password',
            'number' => 23232323

        ]);
    }
}
