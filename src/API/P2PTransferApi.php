<?php

namespace DBerri\LaravelZoop\API;

use DBerri\LaravelZoop\Adapter\CurlAdapter;
use DBerri\LaravelZoop\API\AbstractApi;
use DBerri\LaravelZoop\Entity\Transfer;

class P2PTransferApi extends AbstractApi
{
    protected $apiVersion = 'v2';

    /**
     * Constructor
     *
     * @param CurlAdapter $adapter
     */
    public function __construct()
    {
        $this->adapter = new CurlAdapter($this->getBaseUrl());
    }

    /**
     * Realiza transferências entre contas zoop
     *
     * @param string $owner    identificador do customer pagador
     * @param string $receiver identificador do customer recebedor
     * @param array  $params   array com `amount`, `description` e `transfer_date`
     */
    public function peer2peer($owner, $receiver, $params = [])
    {
        $url      = sprintf('/transfers/%s/to/%s', $owner, $receiver);
        $response = $this->adapter->post($url, $params);
        return new Transfer($response['body']);
    }
}
