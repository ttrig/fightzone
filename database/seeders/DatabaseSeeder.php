<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Alert;
use App\Models\Event;
use App\Models\PaymentArticle;
use App\Models\Text;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private $activities;

    public function run()
    {
        $this->seedUsers();
        $this->seedActivities();
        $this->seedAlerts();
        $this->seedPaymentArticles();
        $this->seedSchedule();
        $this->seedTexts();
    }

    private function seedUsers()
    {
        User::factory(2)->create();
        User::factory()->admin()->create();
    }

    private function seedActivities()
    {
        $slugs = [
            'bjj',
            'boxing',
            'kickboxing',
            'nogi',
            'sac',
            'kids_bjj',
        ];

        $this->activities = collect($slugs)->mapWithKeys(fn($slug) => [
            $slug => Activity::factory()->create(compact('slug'))
        ]);
    }

    private function seedAlerts()
    {
        Alert::factory()->active()->create();
        Alert::factory()->inactive()->create();
    }

    private function seedPaymentArticles()
    {
        PaymentArticle::factory()->create([
            'name_en' => 'BJJ 1 year',
            'name_sv' => 'BJJ 1 år',
            'price' => '5000',
        ]);

        PaymentArticle::factory()->create([
            'name_en' => 'BJJ 6 months',
            'name_sv' => 'BJJ 6 månader',
            'price' => '3000',
        ]);

        PaymentArticle::factory(2)->create();
        PaymentArticle::factory(2)->inactive()->create();
    }

    private function seedSchedule()
    {
        $dow = 0;
        $this->activities->each(function ($activity) use (&$dow) {
            for ($i = 0; $i < 3; $i++) {
                Event::factory()->random()->create([
                    'dow' => ($dow++ % 7) + 1,
                    'activity_id' => $activity->id,
                ]);
            }
        });
    }

    private function seedTexts()
    {
        Text::factory()->long()->create(['route' => 'home', 'name' => 'fightzone']);

        $this->activities->each(function ($activity, $slug) {
            Text::factory()->short()->create(['route' => 'home', 'name' => $slug]);
        });

        Text::factory()->empty()->create(['route' => 'schedule', 'name' => 'info']);

        Text::factory()->create(['route' => 'prices', 'name' => 'info']);
        Text::factory()->create(['route' => 'prices', 'name' => 'combo']);
        Text::factory()->table()->create(['route' => 'prices', 'name' => 'tables']);

        $this->activities->each(function ($activity, $slug) {
            Text::factory()->create(['route' => $slug, 'name' => 'info']);
        });

        Text::factory()->extraLong()->create(['route' => 'join', 'name' => 'info']);

        Text::factory()->extraLong()->create(['route' => 'history', 'name' => 'info']);
        Text::factory()->long()->create(['route' => 'facility', 'name' => 'info']);

        Text::factory()->extraLong()->create(['route' => 'kids_bjj', 'name' => 'info']);
        Text::factory()->extraLong()->create(['route' => 'youth_boxing', 'name' => 'info']);
        Text::factory()->extraLong()->create(['route' => 'youth_kickboxing', 'name' => 'info']);

        Text::factory()->long()->create(['route' => 'payment.index', 'name' => 'info']);
    }
}
