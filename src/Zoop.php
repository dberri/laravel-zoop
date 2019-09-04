<?php

namespace DBerri\LaravelZoop;

class Zoop
{
    /**
     * Array of configurables
     *
     * @var array
     */
    protected $config;

    public function __construct()
    {
        $this->config = config('zoop');
    }

    /**
     * Get Publishable Key
     *
     * @return string
     */
    public function getPublishableKey()
    {
        return $this->config['publishable_key'];
    }
    /**
     * Get Marketplace ID
     *
     * @return string
     */
    public function getMarketplaceId()
    {
        return $this->config['marketplace_id'];
    }

    /**
     * Get endpoint URL
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->config['endpoint'];
    }
}
