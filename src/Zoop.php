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

    /**
     * Version of the API
     *
     * @var array
     */
    protected $apiVersion = 'v1';

    /**
     * Get Publishable Key
     *
     * @return string
     */
    public function getPublishableKey()
    {
        return getenv('ZOOP_PUBLISHABLE_KEY');
    }
    /**
     * Get Marketplace ID
     *
     * @return string
     */
    public function getMarketplaceId()
    {
        return getenv('ZOOP_MARKETPLACE_ID');
    }

    /**
     * Get endpoint URL
     *
     * @return string
     */
    public function getSegimSellerId()
    {
        return getenv('ZOOP_SELLER_ID');
    }

    public function getUrl()
    {
        return getenv('ZOOP_URL');
    }

    /**
     * Get endpoint URL
     *
     * @return string
     */
    public function getBaseUrl()
    {
        $baseUrl       = $this->getUrl();
        $marketplaceId = $this->getMarketplaceId();
        return sprintf('%s%s/marketplaces/%s', $baseUrl, $this->apiVersion, $marketplaceId);
    }
}
