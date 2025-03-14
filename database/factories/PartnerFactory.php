<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PartnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $images = [
            '2022-01-18_21-19-23.png',
            '2022-01-18_21-19-14.png',
            '2022-01-18_21-19-06.png',
            '2022-01-18_21-18-54.png',
            '2022-01-18_21-18-45.jpeg',
            '2022-01-18_21-18-36.png',

        ];

        return [
            'name' => $this->faker->word(),
            'url' => $this->faker->url(),
            'image' => $images[array_rand($images)],
        ];
    }
}
