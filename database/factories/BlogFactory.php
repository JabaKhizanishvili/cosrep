<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $images = [
            '2022-01-24_18-57-45.jpeg',
            '2022-01-24_18-57-53.jpeg',
            '2022-01-24_18-58-12.jpeg',
            '2022-01-24_18-58-29.jpeg',
            '2022-01-24_18-58-37.jpeg',
            '2022-01-24_18-59-01.jpeg',
            '2022-01-24_18-59-09.jpeg',
        ];

        return [
            'name' => $this->faker->unique()->paragraph(1),
            'text' => $this->faker->paragraph(rand(10, 25)),
            'image' => $images[array_rand($images)],
        ];
    }
}
