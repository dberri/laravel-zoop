<?php

namespace DBerri\LaravelZoop\Tests;

use DBerri\LaravelZoop\Entity\AbstractEntity;
use DBerri\LaravelZoop\Entity\Address;
use DBerri\LaravelZoop\Entity\Buyer;
use DBerri\LaravelZoop\Entity\Seller;
use Tests\TestCase;

class EntityTest extends TestCase
{
    public function testBuildEntity()
    {
        $dados = [
            'first_name' => 'João',
            'last_name'  => 'da Silva',
        ];

        $entity = new Seller($dados);

        $this->assertInstanceOf(Seller::class, $entity);
        $this->assertEquals('João', $entity->first_name);
    }

    public function testSubclassEntity()
    {
        $dados = [
            'first_name' => 'João',
            'last_name'  => 'da Silva',
        ];

        $entity = new Seller($dados);

        $this->assertTrue(is_subclass_of($entity, AbstractEntity::class));
    }

    public function testSetsWithMutator()
    {
        $dados = [
            'first_name' => 'João',
            'last_name'  => 'da Silva',
            'address'    => [
                'city'  => 'Brusque',
                'state' => 'SC',
            ],
        ];

        $entity = new Seller($dados);

        $this->assertTrue(is_subclass_of($entity->address, AbstractEntity::class));
    }

    public function testTransformsToArray()
    {
        $dados = [
            'first_name' => 'João',
            'last_name'  => 'da Silva',
        ];
        $entity      = new Seller($dados);
        $entityArray = $entity->toArray();

        $this->assertIsArray($entityArray);
        $this->assertArrayHasKey('first_name', $entityArray);
    }

    public function testTransformNestedObjectToArray()
    {
        $dados = [
            'first_name' => 'João',
            'last_name'  => 'da Silva',
            'address'    => [
                'city'  => 'Brusque',
                'state' => 'SC',
            ],
        ];

        $entity      = new Seller($dados);
        $entityArray = $entity->toArray();

        $this->assertArrayHasKey('address', $entityArray);
        $this->assertIsArray($entityArray['address']);
    }

    public function testMakeCollectionFunction()
    {
        $dados = [
            [
                'first_name' => 'João',
                'last_name'  => 'da Silva',
            ],
            [
                'first_name' => 'Maria',
                'last_name'  => 'de Souza',
            ],
        ];

        $collection = Seller::makeCollection($dados);
        $this->assertIsArray($collection);
        $this->assertTrue(is_subclass_of($collection[0], AbstractEntity::class));
    }

    public function testCanGetRequiredFields()
    {
        $dados = [
            'line1'        => 'Rua Teste',
            'line2'        => '123',
            'neighborhood' => 'Bairro Teste',
            'cidade'       => 'Test City',
            'estado'       => 'SC',
            'postal_code'  => '88123321',
            'country_code' => 'BR',
        ];

        $entity     = new Address($dados);
        $properties = $entity->getRequiredProperties();

        $this->assertIsArray($properties);
        $this->assertContains('line1', $properties);
    }

    public function testValidatesWithSuccess()
    {
        $dados = [
            'line1'        => 'Rua Teste',
            'line2'        => '123',
            'neighborhood' => 'Bairro Teste',
            'city'         => 'Test City',
            'state'        => 'SC',
            'postal_code'  => '88123321',
            'country_code' => 'BR',
        ];
        $address = new Address($dados);

        $this->assertTrue($address->validate());
    }

    public function testValidatesWithFailure()
    {
        $dados = [
            'line1'        => 'Rua Teste',
            'line2'        => '123',
            'neighborhood' => 'Bairro Teste',
            'city'         => 'Test City',
            'state'        => 'SC',
        ];
        $address = new Address($dados);

        $this->assertContains('postal_code', $address->makeValidation());
        $this->assertFalse($address->validate());
    }

    public function testValidatesNestedObject()
    {
        $dados = [
            'first_name'  => 'João',
            'taxpayer_id' => '123',
            'address'     => [
                'line1' => 'Rua Teste',
                'line2' => '123',
                'city'  => 'Brusque',
                'state' => 'SC',
            ],
        ];

        $entity = new Buyer($dados);

        $this->assertFalse($entity->validate());

        $testArray = [
            'email',
            'neighborhood',
            'postal_code',
            'country_code',
        ];

        $this->assertEmpty(array_diff($entity->makeValidation(), $testArray));
    }
}
