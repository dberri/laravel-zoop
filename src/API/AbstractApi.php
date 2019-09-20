<?php

namespace DBerri\LaravelZoop\API;

use DBerri\LaravelZoop\Adapter\CurlAdapter;
use DBerri\LaravelZoop\Zoop;

abstract class AbstractApi extends Zoop
{
    /**
     * Http Adapter Interface
     *
     * @var CurlAdapter
     */
    protected $adapter;

    /**
     * Constructor
     *
     * @param CurlAdapter $adapter
     */
    public function __construct()
    {
        $this->adapter = new CurlAdapter($this->getBaseUrl());
    }
}
