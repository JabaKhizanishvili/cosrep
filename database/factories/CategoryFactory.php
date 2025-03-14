<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $images = [
            '2022-01-24_18-27-52.jpeg',
            '2022-01-24_18-28-04.jpeg',
            '2022-01-24_18-28-15.jpeg',
            '2022-01-24_18-28-28.jpeg',
            '2022-01-24_18-32-58.jpeg',
            '2022-01-24_18-33-22.jpeg',
            '2022-01-24_18-33-08.jpeg',
        ];

        return [
            'name' => $this->faker->unique()->paragraph(1),
            'image' => $images[array_rand($images)],
        ];
    }
}
