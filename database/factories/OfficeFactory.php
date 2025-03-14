<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OfficeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word(),
            'address' => $this->faker->address(),
            'organization_id' => function() {
                return \App\Models\Organization::factory(1)->create()->first()->id;
            },
        ];
    }
}
