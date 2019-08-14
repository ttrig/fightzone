<?php

namespace Tests\Feature;

use Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery as m;
use Tests\TestCase;
use Ttrig\Billmate\Events\OrderCreated;
use Ttrig\Billmate\Exceptions\BillmateException;
use Ttrig\Billmate\Hasher;
use Ttrig\Billmate\Order;
use Ttrig\Billmate\Service as Billmate;

class BillmateTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        #Mail::fake();
        Event::fake();

        $this->billmate = $this->mock(Billmate::class);
        $this->hasher = $this->mock(Hasher::class);
    }

    public function test_accept()
    {
        $this->hasher->expects()->verify(m::any())->andReturnTrue();

        $order = new Order(['status' => Order::PAID]);

        $requestBody = $this->makeFormRequestBody($order);

        $this->post(route('billmate.accept'), $requestBody)
            ->assertOk()
            ->assertViewIs('payment.success')
        ;
    }

    public function test_cancel_with_cancelled_order()
    {
        $this->hasher->expects()->verify(m::any())->andReturnTrue();

        $order = new Order(['status' => Order::CANCELLED]);

        $requestBody = $this->makeFormRequestBody($order);

        $this->post(route('billmate.cancel'), $requestBody)
            ->assertOk()
            ->assertViewIs('payment.cancelled')
        ;
    }

    public function test_cancel_with_failed_order()
    {
        $order = new Order(['status' => Order::FAILED]);

        $requestBody = $this->makeFormRequestBody($order);

        $this->hasher->expects()->verify(m::any())->andReturnTrue();

        $this->post(route('billmate.cancel'), $requestBody)
            ->assertOk()
            ->assertViewIs('payment.failed')
        ;
    }

    public function test_callback_sends_mail()
    {
        $order = new Order();

        $requestBody = $this->makeRequestBody($order);

        $this->hasher->expects()->verify($requestBody)->andReturnTrue();

        $this->billmate
            ->expects()
            ->getPaymentInfo(m::type(Order::class))
            ->andReturn(['foo' => 'bar']);

        $this->json('POST', route('billmate.callback'), $requestBody)
            ->assertStatus(204);

        Event::assertDispatched(OrderCreated::class, function ($event) {
            return $event->order->toArray() === [
                'number' => '12345',
                'orderid' => 'P12345',
                'status' => Order::CREATED,
                'url' => 'https://developer.billmate.se/invoice/12345',
            ];
        });
    }

    public function test_callback_aborts_if_paymentInfo_could_not_be_fetched()
    {
        $order = new Order(['status' => Order::CREATED]);

        $requestBody = $this->makeRequestBody($order);

        $this->hasher->expects()->verify($requestBody)->andReturnTrue();

        $this->billmate
            ->expects()
            ->getPaymentInfo(m::type(Order::class))
            ->andThrows(BillmateException::class);

        $this->json('POST', route('billmate.callback'), $requestBody)
            ->assertStatus(400);

        Event::assertNotDispatched(OrderCreated::class);
    }

    private function makeFormRequestBody(Order $order): array
    {
        return collect($this->makeRequestBody($order))->map(function ($item) {
            return json_encode($item);
        })->all();
    }

    private function makeRequestBody(Order $order): array
    {
        return [
            'credentials' => [
                'hash' => '...',
            ],
            'data' => [
                'number' => $order->number ?: '12345',
                'orderid' => $order->orderid ?: 'P12345',
                'status' => $order->status ?: Order::CREATED,
                'url' => $order->cancelled() || $order->failed()
                    ? ''
                    : 'https://developer.billmate.se/invoice/12345',
            ],
        ];
    }
}
