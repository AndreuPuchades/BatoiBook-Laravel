<?php

namespace Database\Factories;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    protected $model = Sale::class;

    public function definition()
    {
        return [
            'idBook' => $this->faker->numberBetween(1, 100),
            'idUser' => $this->faker->numberBetween(1, 100),
            'date' => $this->faker->dateTimeBetween('-1 years', 'now')->format('Y-m-d'),
            'status' => $this->faker->randomElement([0, 1]),
        ];
    }
}
