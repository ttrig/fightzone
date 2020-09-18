<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Event;

class TvTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        $mondayClass = Event::factory()->create([
            'dow' => 1,
        ]);

        $fridayClass = Event::factory()->openMat()->create([
            'dow' => 5,
        ]);

        $this->get(route('tv'))
            ->assertOk()
            ->assertSeeText(__('app.schedule.day.' . $mondayClass->dow))
            ->assertSeeText(__('app.schedule.day.' . $fridayClass->dow))
            ->assertSeeText($mondayClass->activity->name)
            ->assertSeeText($mondayClass->from_time)
            ->assertSeeText($mondayClass->to_time)
            ->assertSeeText($mondayClass->content)
            ->assertSeeText($fridayClass->activity->name)
            ->assertSeeText($fridayClass->from_time)
            ->assertSeeText($fridayClass->to_time)
            ->assertSeeText('open mat')
        ;
    }
}
