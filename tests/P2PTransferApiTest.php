<?php

namespace DBerri\LaravelZoop\Tests;

use DBerri\LaravelZoop\API\P2PTransferApi;
use Tests\TestCase;

class TransferApiTest extends TestCase
{
    protected $api;

    protected function setUp(): void
    {
        parent::setUp();
        $this->api = new P2PTransferApi();
    }

    public function testTransferP2P()
    {
        $owner    = getenv('ZOOP_SELLER_ID');
        $receiver = getenv('ZOOP_BUYER_ID');
        $transfer = $this->api->peer2peer($owner, $receiver, [
            'amount' => 100,
        ]);

        $this->assertEquals('1.00', $transfer->amount);
    }
}
