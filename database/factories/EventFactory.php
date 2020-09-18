<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition()
    {
        return [
            'activity_id' => fn() => Activity::factory(),
            'dow' => now()->dayOfWeekIso,
            'from_time' => now()->format('H:i'),
            'to_time' => now()->addHour()->format('H:i'),
            'is_enabled' => true,
            'is_open_mat' => false,
            'content_sv' => $this->faker->sentence(2),
            'content_en' => $this->faker->sentence(2),
        ];
    }

    public function random()
    {
        $fromHour = $this->faker->numberBetween(10, 19);

        return $this->state([
            'activity_id' => 1,
            'dow' => $this->faker->numberBetween(1, 7),
            'from_time' => $fromHour . ':00',
            'to_time' => $fromHour + 1 . ':30',
            'is_open_mat' => !rand(0, 7),
            'content_sv' => $this->faker->sentence(2),
            'content_en' => $this->faker->sentence(2),
        ]);
    }

    public function openMat()
    {
        return $this->state([
            'is_open_mat' => true,
        ]);
    }

    public function disabled()
    {
        return $this->state([
            'is_enabled' => false,
        ]);
    }
}
