<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'name' => 'Hamzah',
            'username' => 'Hamzah',
            'email' => 'hamzah@test.com',
        ]);

        \App\Models\User::factory(100)
            ->hasPosts(20)
            ->hasFollowers(7)
            ->hasFollowing(3)
            ->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
