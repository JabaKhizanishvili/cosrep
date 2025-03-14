<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentCustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'appointment_id' => function() {
                return \App\Models\Appointment::factory(1)->create()->first()->id;
            },

            'customer_id' => function() {
                return \App\Models\Customer::factory(1)->create()->first()->id;
            },
        ];
    }
}
