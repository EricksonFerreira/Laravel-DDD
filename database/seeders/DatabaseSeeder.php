<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Domain\Book\Entities\Book;
use App\Domain\Store\Entities\Store;
use App\Domain\User\Entities\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        Book::factory()->count(3)->create();
        Store::factory()->count(3)->create();
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
