<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SeedUsers extends Command
{
    protected $signature = 'seed:users';

    protected $description = 'Seed 22 users into the database';

    public function handle()
    {
        for ($i = 1; $i <= 100; $i++) {
            User::factory()->create([
                'name' => 'User ' . $i,
                'email' => 'user' . $i . '@example.com',
                'password' => Hash::make('password'), // Change 'password' as needed
                'location' => 'Sample Location ' . $i,
            ]);
        }


    }
}
