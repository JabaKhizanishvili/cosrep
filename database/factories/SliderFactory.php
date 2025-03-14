<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $images = [
            '2022-01-24_18-13-02.jpeg',
            '2022-01-24_18-13-18.jpeg',
            '2022-01-24_18-21-53.jpeg',
            '22022-01-24_18-22-09.jpeg',
            '2022-01-24_18-22-30.jpeg',
            '2022-01-24_18-23-49.jpeg',
            '2022-01-24_18-23-49.jpeg',
        ];
        return [
            'name' => $this->faker->paragraph(1),
            'url' => $this->faker->url(),
            'image' => $images[array_rand($images)],
        ];
    }
}
