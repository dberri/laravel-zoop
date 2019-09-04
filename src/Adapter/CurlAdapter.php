<?php

namespace DBerri\LaravelZoop\Adapter;

use DBerri\LaravelZoop\Adapter\AdapterInterface;
use DBerri\LaravelZoop\Exceptions\HttpException;

class CurlAdapter implements AdapterInterface
{
    public function get($url)
    {
        return $this->request($url);
    }

    public function post($url, $content = '')
    {
        return $this->request($url, 'POST', $content);
    }

    public function put($url, $content = '')
    {
        return $this->request($url, 'PUT', $content);
    }

    public function delete($url)
    {
        return $this->request($url, 'DELETE');
    }

    /**
     * Configura o CURL para realizar a requisição
     *
     * @param string $url
     * @param string $method
     * @param array  $data
     * @return string
     */
    public function request($url, $method = 'GET', $data = [])
    {
        $curl    = curl_init();
        $opts    = [];
        $headers = [
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
        ];

        if ($method === 'GET' && !empty($data)) {
            $url .= '?' . http_build_query($data);
        }

        $opts[CURLOPT_CONNECTTIMEOUT] = 30;
        $opts[CURLOPT_HTTPHEADER]     = $headers;
        $opts[CURLOPT_RETURNTRANSFER] = true;
        $opts[CURLOPT_SSL_VERIFYHOST] = 2;
        $opts[CURLOPT_SSL_VERIFYPEER] = false;
        $opts[CURLOPT_TIMEOUT]        = 80;
        $opts[CURLOPT_URL]            = config('zoop.url') . ltrim($url, '/');
        $opts[CURLOPT_USERPWD]        = config('zoop.publishable_key');

        if ($method === 'PUT' || $method === 'DELETE') {
            $opts[CURLOPT_CUSTOMREQUEST] = $method;
        }

        if ($method === 'POST' || $method === 'PUT') {
            $opts[CURLOPT_POSTFIELDS] = http_build_query($data);
        }

        if ($method === 'POST') {
            $opts[CURLOPT_POST] = 1;
        }

        curl_setopt_array($curl, $opts);
        $response_body = curl_exec($curl);
        $response_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($response_code >= 300) {
            throw HttpException($response_code, $response_body);
        }

        return ['body' => json_decode($response_body, true), 'statusCode' => $response_code];
    }
}
