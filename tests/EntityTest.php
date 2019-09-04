<?php

namespace DBerri\LaravelZoop\Tests;

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
}
