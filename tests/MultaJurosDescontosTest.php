<?php

namespace DBerri\LaravelZoop\Tests;

use DBerri\LaravelZoop\API\BuyerApi;
use DBerri\LaravelZoop\API\SellerApi;
use DBerri\LaravelZoop\API\TransactionApi;
use DBerri\LaravelZoop\Entity\Transaction;
use Tests\TestCase;

class MultaJurosDescontosTest extends TestCase
{
    protected $api;

    protected function setUp(): void
    {
        parent::setUp();
        $this->api = new TransactionApi();
    }

    public function testCreateBoletoWithInterestAndLateFee()
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
                    'expiration_date'      => '2019-09-10',
                    'payment_limit_date'   => '2019-09-10',
                    'body_instructions'    => 'Teste',
                    'billing_instructions' => [
                        'late_fee' => [
                            'mode'   => 'FIXED',
                            'amount' => 100,
                        ],
                        'interest' => [
                            'mode'       => 'MONTHLY_PERCENTAGE',
                            'percentage' => 2,
                        ],
                        // 'discount' => [
                        //     'mode'       => 'FIXED',
                        //     'limit_date' => '2019-09-10',
                        //     'amount'     => 2000,
                        // ],
                    ],
                ],
            ];
            $localTransaction = new Transaction($dados);
            // $transaction      = $this->api->create($localTransaction);
            // \Log::info($transaction->toArray());

            $this->assertTrue(true);
        }
    }

    public function testCreateBoletoWithDiscount()
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
                    'expiration_date'      => '2019-09-10',
                    'payment_limit_date'   => '2019-09-10',
                    'body_instructions'    => 'Teste',
                    'billing_instructions' => [
                        'discount' => [
                            [
                                'mode'       => 'FIXED',
                                'limit_date' => '2019-09-10',
                                'amount'     => 2000,
                            ],
                        ],
                    ],
                ],
            ];
            $localTransaction = new Transaction($dados);
            // $transaction      = $this->api->create($localTransaction);
            // \Log::info($transaction->toArray());

            $this->assertTrue(true);
        }
    }

    public function testCreateBoletoWithDiscountInterestAndLateFee()
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
                    'expiration_date'      => '2019-09-06',
                    'payment_limit_date'   => '2019-09-20',
                    'body_instructions'    => 'Teste',
                    'billing_instructions' => [
                        'late_fee' => [
                            'mode'   => 'FIXED',
                            'amount' => 100,
                        ],
                        'interest' => [
                            'mode'       => 'MONTHLY_PERCENTAGE',
                            'percentage' => 2,
                        ],
                        'discount' => [
                            [
                                'mode'       => 'FIXED',
                                'limit_date' => '2019-09-10',
                                'amount'     => 2000,
                            ],
                        ],
                    ],
                ],
            ];
            $localTransaction = new Transaction($dados);
            $transaction      = $this->api->create($localTransaction);
            \Log::info($transaction->toArray());

            $this->assertTrue(true);
        }
    }
}
