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
        $this->config = [
            'marketplace_id'  => getenv('ZOOP_MARKETPLACE_ID'),
            'segim_seller_id' => getenv('ZOOP_SEGIM_SELLER_ID'),
            'publishable_key' => getenv('ZOOP_PUBLISHABLE_KEY'),
            'url'             => getenv('ZOOP_URL'),
        ];
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
    public function getSegimSellerId()
    {
        return $this->config['segim_seller_id'];
    }

    /**
     * Get endpoint URL
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->config['url'];
    }
}
