<?php

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
        factory(User::class, 2)->create();
        factory(User::class)->state('admin')->create();
    }

    private function seedActivities()
    {
        $slugs = [
            'bjj',
            'boxing',
            'kickboxing',
            'nogi',
            'wrestling',
            'sac',
            'kids_bjj',
        ];

        $this->activities = collect($slugs)->mapWithKeys(fn($slug) => [
            $slug => factory(Activity::class)->create(compact('slug'))
        ]);
    }

    private function seedAlerts()
    {
        factory(Alert::class)->state('active')->create();
        factory(Alert::class)->state('inactive')->create();
    }

    private function seedPaymentArticles()
    {
        factory(PaymentArticle::class)->create([
            'name_en' => 'BJJ 1 year',
            'name_sv' => 'BJJ 1 år',
            'price' => '5000',
        ]);

        factory(PaymentArticle::class)->create([
            'name_en' => 'BJJ 6 months',
            'name_sv' => 'BJJ 6 månader',
            'price' => '3000',
        ]);

        factory(PaymentArticle::class, 2)->create();
        factory(PaymentArticle::class, 2)->state('inactive')->create();
    }

    private function seedSchedule()
    {
        $this->activities->each(function ($activity) {
            factory(Event::class, 5)->states('random')->create(['activity_id' => $activity->id]);
        });
    }

    private function seedTexts()
    {
        factory(Text::class)->state('long')->create(['route' => 'home', 'name' => 'fightzone']);

        $this->activities->each(function ($activity, $slug) {
            factory(Text::class)->state('short')->create(['route' => 'home', 'name' => $slug]);
        });

        factory(Text::class)->state('empty')->create(['route' => 'schedule', 'name' => 'info']);

        factory(Text::class)->create(['route' => 'prices', 'name' => 'info']);
        factory(Text::class)->create(['route' => 'prices', 'name' => 'combo']);
        factory(Text::class)->state('table')->create(['route' => 'prices', 'name' => 'tables']);

        $this->activities->each(function ($activity, $slug) {
            factory(Text::class)->create(['route' => $slug, 'name' => 'info']);
        });

        factory(Text::class)->state('extra-long')->create(['route' => 'join', 'name' => 'info']);

        factory(Text::class)->state('extra-long')->create(['route' => 'about', 'name' => 'info']);
        factory(Text::class)->state('long')->create(['route' => 'about', 'name' => 'facility']);

        factory(Text::class)->state('extra-long')->create(['route' => 'kids_bjj', 'name' => 'info']);
        factory(Text::class)->state('extra-long')->create(['route' => 'kids_boxing', 'name' => 'info']);

        factory(Text::class)->state('long')->create(['route' => 'payment.index', 'name' => 'info']);
    }
}
