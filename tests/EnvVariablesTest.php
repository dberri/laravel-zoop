<?php

namespace DBerri\LaravelZoop\Tests;

use DBerri\LaravelZoop\Zoop;
use Tests\TestCase;

class EnvVariablesTest extends TestCase
{
    public function testGetMarketplaceId()
    {
        $zoop      = new Zoop();
        $mkplaceId = $zoop->getMarketplaceId();
        $this->assertEquals('7cbc76475bde4767b0e514f5bbb8db4e', $mkplaceId);
    }

    public function testGetZpkId()
    {
        $zoop = new Zoop();
        $zpk  = $zoop->getPublishableKey();
        $this->assertEquals('zpk_prod_6ChVKIX2ozBCFG5byaJjNm2r:', $zpk);
    }
}
