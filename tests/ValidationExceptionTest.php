<?php

namespace DBerri\LaravelZoop\Tests;

use DBerri\LaravelZoop\API\TransactionApi;
use DBerri\LaravelZoop\Entity\Transaction;
use DBerri\LaravelZoop\Exception\ValidationException;
use Tests\TestCase;

class ValidationExceptionTest extends TestCase
{
    protected $api;

    protected function setUp(): void
    {
        parent::setUp();
        $this->api = new TransactionApi();
    }

    public function testThrowsValidatonException()
    {
        $this->expectException(ValidationException::class);

        $transaction = new Transaction([
            "amount"       => 10000,
            "currency"     => "BRL",
            "payment_type" => "boleto",
            "on_behalf_of" => getenv('ZOOP_SELLER_ID'),
        ]);

        $createdTransaction = $this->api->create($transaction);
    }

    public function testExceptionHasReasons()
    {
        try {
            $transaction = new Transaction([
                "amount"       => 10000,
                "currency"     => "BRL",
                "payment_type" => "boleto",
                "on_behalf_of" => getenv('ZOOP_SELLER_ID'),
            ]);

            $createdTransaction = $this->api->create($transaction);
        } catch (\Exception $e) {
            $this->assertEquals(422, $e->getCode());
            $this->assertIsArray($e->getErrors());
        }
    }
}
