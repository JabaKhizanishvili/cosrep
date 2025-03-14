<?php

namespace Database\Factories;

use App\Models\Trainer;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrainingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $images = [
            '2022-01-24_18-44-29.jpeg',
            '2022-01-24_18-44-14.jpeg',
            '2022-01-24_18-43-59.jpeg',
            '2022-01-24_18-43-45.jpeg',
            '2022-01-24_18-43-28.jpeg',
            '2022-01-24_18-43-13.jpeg',
            '2022-01-24_18-41-31.jpeg',
        ];


        $trainer = Trainer::all()->random(1)->first();
        if($trainer){
            $t_id = $trainer->id;
        }else{
            $t_id = \App\Models\Trainer::factory(1)->create()->first()->id;
        }
        return [
            'trainer_id' => $t_id,
            'category_id' => function() {
                return \App\Models\Category::factory(1)->create()->first()->id;
            },
            'name' => $this->faker->unique()->paragraph(1),
            'text' => $this->faker->paragraph(rand(20, 30)),
            'status' => 1,
            'point_to_pass' => 0,
            'image' => $images[array_rand($images)],
            'resources' => '[{"name":"Curabitur aliquet quam id dui posuere blandit. Curabitur non nulla","url":"https:\/\/en.wikipedia.org\/wiki\/Plane_(Unicode)#Basic_Multilingual_Plane"},{"name":"Curabitur aliquet quam id dui posuere blandit. Curabitur non nulla","url":"https:\/\/en.wikipedia.org\/wiki\/Plane_(Unicode)#Basic_Multilingual_Plane"},{"name":"Curabitur aliquet quam id dui posuere blandit. Curabitur non nulla","url":"https:\/\/en.wikipedia.org\/wiki\/Plane_(Unicode)#Basic_Multilingual_Plane"},{"name":"Curabitur aliquet quam id dui posuere blandit. Curabitur non nulla","url":"https:\/\/en.wikipedia.org\/wiki\/Plane_(Unicode)#Basic_Multilingual_Plane"},{"name":"Curabitur aliquet quam id dui posuere blandit. Curabitur non nulla","url":"https:\/\/en.wikipedia.org\/wiki\/Plane_(Unicode)#Basic_Multilingual_Plane"},{"name":"Curabitur aliquet quam id dui posuere blandit. Curabitur non nulla","url":"https:\/\/en.wikipedia.org\/wiki\/Plane_(Unicode)#Basic_Multilingual_Plane"}]',
        ];
    }
}
