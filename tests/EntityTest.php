<?php

namespace DBerri\LaravelZoop\Tests;

use DBerri\LaravelZoop\Entity\AbstractEntity;
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
}
