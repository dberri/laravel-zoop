<?php

namespace DBerri\LaravelZoop\Tests;

use DBerri\LaravelZoop\API\BuyerApi;
use DBerri\LaravelZoop\API\SellerApi;
use DBerri\LaravelZoop\API\TransactionApi;
use DBerri\LaravelZoop\Entity\Transaction;
use Tests\TestCase;

class TransactionApiTest extends TestCase
{
    protected $api;

    protected function setUp(): void
    {
        parent::setUp();
        $this->api = new TransactionApi();
    }

    public function testGetAllTransactions()
    {
        $transactions = $this->api->getAll();
        $this->assertIsArray($transactions);
    }

    public function testCreateTransaction()
    {
        $buyerApi = new BuyerApi();
        $buyers   = $buyerApi->getAll();

        $sellerApi = new SellerApi();
        $seller    = $sellerApi->getById(config('zoop.seller_id'));

        if (count($buyers) > 0) {
            $buyer = reset($buyers);
            $dados = [
                'amount'       => 10050,
                'description'  => 'Geração de boleto teste',
                'payment_type' => 'boleto',
                'on_behalf_of' => config('zoop.seller_id'),
                'customer'     => $buyer->id,
            ];
            $localTransaction = new Transaction($dados);
            // $transaction      = $this->api->create($localTransaction);
            // $this->assertTrue($transaction->id !== '');
            // $this->assertEquals(1005, $transaction->amount);
            // $this->assertEquals("pending", $transaction->status);
        }
    }

    public function testGetById()
    {
        $transactions     = $this->api->getAll();
        $localTransaction = array_pop($transactions);
        $transaction      = $this->api->getById($localTransaction->id);
        $this->assertEquals(config('zoop.seller_id'), $transaction->on_behalf_of);
        $this->assertEquals('pending', $transaction->status);
    }
}
