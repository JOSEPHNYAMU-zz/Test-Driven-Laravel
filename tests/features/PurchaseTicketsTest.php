<?php

use App\Concert;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PurchaseTicketsTest extends TestCase
{
    /** @test */
    function customer_can_purchase_concert_tickets()
    {
        $concert = factory(Concert::class)->create([
            'ticket_price' => 3250
        ]);

        $this->json('POST', '/concerts/{$concert->id}/orders', [
            'email' => 'jnjogu@cytonn.com',
            'ticket_quantity' => 3,
            'payment_token' => $paymentGateway->getValidTestToken(),
        ]);

        $this->assertEquals(9750, $paymentGateway->totalCharges());

        $order = $concert->orders()->where('email',  'jnjogu@cytonn.com')->first();
        $this->assertNotNull($order);
        $this->assertEquals(3, $order->tickets->count());
    }
}