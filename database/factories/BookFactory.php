<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $ISBN = '';
        for ($i = 0; $i < 13; $i++) {
            $ISBN .= $this->faker->numberBetween(0, 9);
        }
        return [
            'title' => Str::random(10),
            'author' => Str::random(10),
            'publication_year' => $this->faker->numberBetween(1950, 2024),
            'ISBN' => $ISBN,
        ];
    }
}
