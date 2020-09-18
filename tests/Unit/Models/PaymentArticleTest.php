<?php

namespace Tests\Unit\Models;

use App\Models\PaymentArticle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Ttrig\Billmate\Article as BillmateArticle;

class PaymentArticleTest extends TestCase
{
    use RefreshDatabase;

    public function test_getNameAttribute()
    {
        $article = PaymentArticle::factory()->create();

        $this->assertEquals($article->name_sv, $article->name);

        app()->setLocale('en');

        $this->assertEquals($article->name_en, $article->name);
    }

    public function test_getFormattedPriceAttribute()
    {
        $article = PaymentArticle::factory()->create(['price' => 1000]);

        $this->assertEquals('1 000', $article->formatted_price);

        app()->setLocale('en');

        $this->assertEquals('1,000', $article->formatted_price);
    }

    public function test_billmateArticle()
    {
        $article = PaymentArticle::factory()->create(['price' => 1000]);

        $this->assertInstanceOf(BillmateArticle::class, $article->billmateArticle());
    }
}
