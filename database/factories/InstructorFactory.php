<?php

namespace Database\Factories;

use App\Models\Instructor;
use Illuminate\Database\Eloquent\Factories\Factory;

class InstructorFactory extends Factory
{
    protected $model = Instructor::class;

    public function definition()
    {
        return [
            'activity_id' => 1,
            'name' => $this->faker->name,
            'image' => $this->faker->imageUrl(500, 700, 'cats'),
            'black_belt' => 0,
            'content_sv' => $this->faker->jobTitle,
            'content_en' => $this->faker->jobTitle,
        ];
    }
}
