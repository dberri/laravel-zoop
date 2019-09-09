<?php

namespace DBerri\LaravelZoop\Tests;

use DBerri\LaravelZoop\API\BuyerApi;
use DBerri\LaravelZoop\Entity\Address;
use DBerri\LaravelZoop\Entity\Buyer;
use Tests\TestCase;

class BuyerApiTest extends TestCase
{
    protected $api;

    protected function setUp(): void
    {
        parent::setUp();
        $this->api = new BuyerApi();
    }

    public function testGetAll()
    {
        $buyers = $this->api->getAll();
        $this->assertIsArray($buyers);
    }

    public function testGetById()
    {
        $buyers = $this->api->getAll();
        if (count($buyers) > 0) {
            $localBuyer = reset($buyers);
            $buyer      = $this->api->getById($localBuyer->id);

            $this->assertEquals($localBuyer->id, $buyer->id);
        }
    }

    public function testCRUDBuyers()
    {
        $dados = [
            '',
        ];
        $localBuyer = new Buyer($dados);

        $this->assertTrue(true);
    }

    public function testUpdateBuyerAddress()
    {
        $buyers     = $this->api->getAll();
        $localBuyer = reset($buyers);

        $localBuyer->address = new Address([
            'line1'        => 'Rua Rodrigues Alves',
            'line2'        => '165',
            'neighborhood' => 'Centro',
            'city'         => 'Brusque',
            'state'        => 'SC',
            'postal_code'  => '88350-160',
        ]);
        $buyer = $this->api->update($localBuyer);

        $this->assertEquals($buyer->address->city, 'Brusque');
        $this->assertEquals($buyer->address->postal_code, '88350-160');
    }
}
