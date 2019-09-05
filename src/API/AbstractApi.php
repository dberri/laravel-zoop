<?php

namespace DBerri\LaravelZoop\API;

use DBerri\LaravelZoop\Adapter\CurlAdapter;

abstract class AbstractApi
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
        $this->adapter = new CurlAdapter();
    }
}
