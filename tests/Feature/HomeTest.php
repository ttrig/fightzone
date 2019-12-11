<?php

namespace Tests\Feature;

use App\Models\Alert;
use App\Models\Event;
use App\Models\Text;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    public function test_home()
    {
        $text = factory(Text::class)->create([
            'route' => 'home',
            'name' => 'fightzone',
        ]);

        $this->get('/')
            ->assertOk()
            ->assertSeeTextInOrder([
                __('app.nav.home'),
                __('app.nav.schedule'),
                __('app.nav.prices'),
                __('app.nav.join'),
                __('app.nav.training'),
                __('app.nav.about'),
                __('app.nav.contact'),
            ])
            ->assertSeeTextInOrder([
                __('app.activity.bjj'),
                __('app.activity.boxing'),
                __('app.activity.kickboxing'),
                __('app.activity.wrestling'),
                __('app.activity.nogi'),
                __('app.activity.sac'),
                __('app.activity.gym'),
            ])
            ->assertSeeTextInOrder([
                __('app.home.more'),
                __('app.home.previous'),
                __('app.home.next'),
                __('app.home.welcome'),
                __('app.home.welcome2'),
                __('app.home.more_about_fightzone'),
                __('app.home.register'),
                __('app.home.schedule.title'),
                __('app.home.schedule.no_training'),
                __('app.home.schedule.link'),
            ])
            ->assertSeeTextInOrder([
                'Kopparbergsgatan 2B, 214 44',
                'info@fightzone.se',
            ])
            ->assertSeeText($text->content)
        ;
    }

    public function test_home_when_schedule_is_not_empty()
    {
        $schedule = factory(Event::class)->create();

        $this->get('/')
            ->assertOk()
            ->assertSeeTextInOrder([
                $schedule->from_time,
                $schedule->to_time,
                $schedule->activity->name,
                $schedule->content,
            ]);
    }

    public function test_home_with_alert()
    {
        $alert = factory(Alert::class)->create();

        $this->get('/')->assertOk()->assertSeeText($alert->content);
    }

    public function test_lang_change_from_en_to_sv()
    {
        $this->assertEquals('sv', app()->getLocale());

        $this->get(route('lang', 'en'))
            ->assertRedirect()
            ->assertSessionHas('locale', 'en')
        ;

        $this->assertEquals('en', app()->getLocale());
    }

    public function test_locale_is_set_to_default_when_unknown()
    {
        $this->from(route('home'))
            ->get(route('lang', 'xx'))
            ->assertRedirect(route('home'))
        ;

        $this->assertEquals('en', app()->getLocale());
    }
}
