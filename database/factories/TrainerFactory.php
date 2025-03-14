<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TrainerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $images = [
            '2022-01-24_18-50-52.jpeg',
            '2022-01-24_18-49-27.jpeg',
            '2022-01-24_18-49-54.jpeg',
            '2022-01-24_18-50-01.jpeg',
            '2022-01-24_18-50-07.jpeg',
            '2022-01-24_18-50-15.jpeg',
            '2022-01-24_18-50-25.jpeg',
        ];

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'signature' => $this->faker->unique()->url(),
            'facebook' => 'https://facebook.com',
            'twitter' => 'https://twitter.com',
            'linkedin' => 'https://linkedin.com',
            'instagram' => 'https://instagram.com',
            'image' => $images[array_rand($images)],
        ];
    }
}
