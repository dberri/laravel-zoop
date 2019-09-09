<?php

namespace DBerri\LaravelZoop\Tests;

use DBerri\LaravelZoop\API\SellerApi;
use DBerri\LaravelZoop\Entity\Address;
use DBerri\LaravelZoop\Entity\Seller;
use Tests\TestCase;

class SellerApiTest extends TestCase
{
    protected $api;

    protected $sellerId;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sellerId = '';
        $this->api      = new SellerApi();
    }

    public function testGetAllSellers()
    {
        $sellers = $this->api->getAll();
        $this->assertIsArray($sellers);
    }

    public function testGetSellersById()
    {
        $seller = $this->api->getById(config('zoop.seller_id'));
        $this->assertEquals(config('zoop.seller_id'), $seller->id);
    }

    public function testCRUDIndividualSeller()
    {
        $dados = [
            'first_name'  => 'John Doe',
            'taxpayer_id' => '02811654089',
            'email'       => "john@doe.com",
        ];
        $localSeller = new Seller($dados);
        $seller      = $this->api->createIndividual($localSeller);
        $this->assertTrue($seller->id !== '');
        $this->assertEquals('John Doe', $seller->first_name);

        $seller->first_name = 'Josh Doe';
        $updatedSeller      = $this->api->updateIndividual($seller);
        $this->assertEquals('Josh Doe', $updatedSeller->first_name);
        $this->assertEquals('02811654089', $updatedSeller->taxpayer_id);

        $deleted = $this->api->delete($seller->id);
        $this->assertEquals($seller->id, $deleted['id']);

        $sellers = $this->api->getAll();
        $this->assertEquals(1, count($sellers));
    }

    public function testUpdateSellerAddress()
    {
        $seller          = $this->api->getById(config('zoop.seller_id'));
        $seller->address = new Address([
            'line1'        => 'Rua Rodrigues Alves',
            'line2'        => '165',
            'neighborhood' => 'Centro',
            'city'         => 'Brusque',
            'state'        => 'SC',
            'postal_code'  => '88350-160',
        ]);
        $updatedSeller = $this->api->updateIndividual($seller);
        $this->assertTrue(!is_null($seller->address->line1));
    }
}
