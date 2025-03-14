<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TrainingTestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $randNumber = rand(3, 6);

        return [
            'training_id' => function() {
                return \App\Models\Training::factory(1)->create()->first()->id;
            },
            'question' => $this->faker->paragraph(2),
            'answers' => json_encode($this->faker->words($randNumber)),
            'correct' => rand(1, $randNumber - 1)
        ];
    }
}
