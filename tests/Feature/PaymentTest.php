<?php

namespace Tests\Feature;

use App\Models\PaymentArticle;
use App\Models\Text;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Mockery as m;
use Tests\TestCase;
use Ttrig\Billmate\Article as BillmateArticle;
use Ttrig\Billmate\Checkout;
use Ttrig\Billmate\Exceptions\BillmateException;
use Ttrig\Billmate\Service as BillmateService;

class PaymentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->article = PaymentArticle::factory()->create();
    }

    public function test_index()
    {
        $infoText = Text::factory()->create([
            'route' => 'payment.index',
            'name' => 'info',
        ]);

        $this->get(route('payment.index'))
            ->assertOk()
            ->assertSee($infoText->content)
            ->assertSeeText($this->article->name)
        ;
    }

    public function test_getMonthlyCosts_happy_path()
    {
        $this->mock(BillmateService::class)
            ->expects()
            ->getPaymentPlans(m::type(BillmateArticle::class))
            ->andReturn([
                [
                    'nbrofmonths' => '3',
                    'monthlycost' => '41600',
                ],
                [
                    'nbrofmonths' => '6',
                    'monthlycost' => '24700',
                ],
                [
                    'nbrofmonths' => '12',
                    'monthlycost' => '15500',
                ],
            ])
        ;

        $this->getJson(route('payment.monthly-costs'))
            ->assertOk()
            ->assertJson([$this->article->number => 155])
        ;

        $this->assertTrue(
            cache()->has('billmate-payment-plans-for-article-' . $this->article->id)
        );
    }

    public function test_getMonthlyCosts_aborts_on_normal_request()
    {
        $this->mock(BillmateService::class);
        $this->get(route('payment.monthly-costs'))->assertStatus(400);
    }

    public function test_checkout_happy_path()
    {
        $this->mock(BillmateService::class)
            ->expects()
            ->initCheckout(m::type('object'))
            ->andReturn(new Checkout([
                'number' => '123',
                'status' => 'WaitingForPurchase',
                'orderid' => 'P12345-67',
                'url' => 'https://checkout.billmate.se/123/456/test',
            ]))
        ;

        $this->get(route('payment.checkout', $this->article))
            ->assertOk()
            ->assertSeeText($this->article->name)
            ->assertSeeText($this->article->content)
            ->assertSeeText($this->article->formatted_price)
            ->assertSee('<iframe', $escaped = false)
            ->assertSee('https://checkout.billmate.se/123/456/test', $escaped = false)
        ;
    }

    public function test_checkout_sad_path()
    {
        Log::shouldReceive('critical');

        $this->mock(BillmateService::class)
            ->expects()
            ->initCheckout(m::type('object'))
            ->andThrows(BillmateException::class, 'Billmate error')
        ;

        $this->get(route('payment.checkout', $this->article))
            ->assertOk()
            ->assertSeeText($this->article->name)
            ->assertSeeText($this->article->content)
            ->assertSeeText($this->article->formatted_price)
            ->assertSeeText(__('app.payment.checkout.not_loaded'))
            ->assertDontSee('<iframe')
        ;
    }
}
