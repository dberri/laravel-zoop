<?php

namespace DBerri\LaravelZoop\Tests;

use DBerri\LaravelZoop\API\TransferApi;
use Tests\TestCase;

class TransferApiTest extends TestCase
{
    protected $api;

    protected function setUp(): void
    {
        parent::setUp();
        $this->api = new TransferApi();
    }

    public function testTransferP2P()
    {
        $owner    = getenv('ZOOP_SELLER_ID');
        $receiver = getenv('ZOOP_BUYER_ID');
        $transfer = $this->api->peer2peer($owner, $receiver, [
            'amount' => 100,
        ]);

        $this->assertTrue(true);
    }
}
