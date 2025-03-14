<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $rand_day = rand(5, 7);

        $start_date_future = date("Y-m-d H:", strtotime("+ $rand_day day")) . "00:00";
        $start_date_old = date("Y-m-d H:", strtotime("- $rand_day day")) . "00:00";
        //create current appointment
        $start_date_current = date("Y-m-d H:") . "00:00";
        $arr = [$start_date_future, $start_date_old, $start_date_current];
        $start_date = $arr[array_rand($arr)];
        $duration = rand(1, 5);

        $end_date = date("Y-m-d H:i", strtotime("$start_date + $duration Hour"));
        $repeat = rand(5, 12);


        return [
            'training_id' => function() {
                return \App\Models\Training::factory(1)->create()->first()->id;
            },

            'name' => $this->faker->unique()->paragraph(1),
            'start_date' => $start_date,
            'end_date' => $end_date,
            'repeat' => $repeat,
        ];

    }
}
