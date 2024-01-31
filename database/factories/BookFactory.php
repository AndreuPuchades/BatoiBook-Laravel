<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        return [
            'user_id' => rand(1, 100),
            'module_id' => Module::inRandomOrder()->value('code'),
            'publisher' => $this->faker->company,
            'price' => $this->faker->randomFloat(2, 5, 25),
            'pages' => $this->faker->numberBetween(50, 500),
            'status' => $this->faker->randomElement(['new', 'good', 'used', 'bad']),
            'photo' => $this->faker->imageUrl(),
            'comments' => $this->faker->paragraph,
            'soldDate' => null,
            'admit' => 1,
        ];
    }

    public function sold()
    {
        return $this->state([
            'soldDate' => $this->faker->dateTimeBetween('-1 years', 'now')->format('Y-m-d'),
        ]);
    }
}
