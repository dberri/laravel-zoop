<?php

namespace DBerri\LaravelZoop\Tests;

use DBerri\LaravelZoop\API\BuyerApi;
use DBerri\LaravelZoop\API\SellerApi;
use DBerri\LaravelZoop\API\TransactionApi;
use DBerri\LaravelZoop\Entity\SplitTransaction;
use DBerri\LaravelZoop\Entity\Transaction;
use Tests\TestCase;

class SplitTransactionApiTest extends TestCase
{
    protected $api;

    protected function setUp(): void
    {
        parent::setUp();
        $this->api = new TransactionApi();
    }

    public function testCreateSplitTransaction()
    {
        $buyerApi = new BuyerApi();
        $buyers   = $buyerApi->getAll();

        $sellerApi = new SellerApi();
        $seller    = $sellerApi->getById(config('zoop.seller_id'));

        if (count($buyers) > 0) {
            $buyer = reset($buyers);
            $dados = [
                'amount'         => 15000,
                'description'    => 'Geração de boleto teste',
                'payment_type'   => 'boleto',
                'on_behalf_of'   => config('zoop.seller_id'),
                'customer'       => $buyer->id,
                'payment_method' => [
                    'expiration_date'    => '2019-09-09',
                    'payment_limit_date' => '2019-09-10',
                    'body_instructions'  => 'Teste',
                ],
            ];
            $localTransaction = new Transaction($dados);
            $transaction      = $this->api->create($localTransaction);

            $dadosSplit = [
                'recipient' => config('zoop.seller_id'),
                'amount'    => 490,
            ];
            $localSplitTransaction = new SplitTransaction($dadosSplit);
            $splitTransaction      = $this->api->createSplitTransaction($transaction->id, $localSplitTransaction);

            $this->assertTrue($splitTransaction->id !== '');
            $this->assertEquals("pending", $transaction->status);
        }
    }
}
