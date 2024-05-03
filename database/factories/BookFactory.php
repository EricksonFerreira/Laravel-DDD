<?php

namespace Database\Factories;

use App\Domain\Book\Entities\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence,
            'isbn' => $this->faker->unique()->randomNumber(),
            'value' => $this->faker->randomFloat(2, 1, 100),
        ];
    }
}
