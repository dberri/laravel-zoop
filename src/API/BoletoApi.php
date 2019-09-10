<?php

namespace DBerri\LaravelZoop\API;

use DBerri\LaravelZoop\API\AbstractApi;

class BoletoApi extends AbstractApi
{
    public function getById($id)
    {
        $url      = sprintf('/boletos/%s', $id);
        $response = $this->adapter->get($url);
        return json_decode(json_encode($response['body']));
    }

    public function sendToEmail($id)
    {
        $url      = sprintf('/boletos/%s/emails', $id);
        $response = $this->adapter->post($url);
        return json_decode(json_encode($response['body']));
    }
}
