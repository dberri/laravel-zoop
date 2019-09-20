<?php

namespace DBerri\LaravelZoop\Adapter;

use DBerri\LaravelZoop\Adapter\AdapterInterface;
use DBerri\LaravelZoop\Exception\ConflictException;
use DBerri\LaravelZoop\Exception\HttpException;
use DBerri\LaravelZoop\Exception\NotFoundException;

class CurlAdapter implements AdapterInterface
{
    protected $baseUrl;

    public function __construct($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    public function get($url, $headers = [])
    {
        return $this->request($url, 'GET', [], $headers);
    }

    public function post($url, $content = '', $headers = [])
    {
        return $this->request($url, 'POST', $content, $headers);
    }

    public function put($url, $content = '', $headers = [])
    {
        return $this->request($url, 'PUT', $content, $headers);
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
    public function request($url, $method = 'GET', $data = [], $paramHeaders = [])
    {
        $curl           = curl_init();
        $opts           = [];
        $defaultHeaders = [
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
        ];
        $headers = array_merge($defaultHeaders, $paramHeaders);
        array_walk($headers, function (&$val, $key) {
            $val = $key . ': ' . $val;
        });

        if ($method === 'GET' && !empty($data)) {
            $url .= '?' . http_build_query($data);
        }

        $opts[CURLOPT_CONNECTTIMEOUT] = 30;
        $opts[CURLOPT_HTTPHEADER]     = array_values($headers);
        $opts[CURLOPT_RETURNTRANSFER] = true;
        $opts[CURLOPT_SSL_VERIFYHOST] = 2;
        $opts[CURLOPT_SSL_VERIFYPEER] = false;
        $opts[CURLOPT_TIMEOUT]        = 80;
        $opts[CURLOPT_URL]            = $this->baseUrl . $url;
        $opts[CURLOPT_USERPWD]        = getenv('ZOOP_PUBLISHABLE_KEY');

        if ($method === 'PUT' || $method === 'DELETE') {
            $opts[CURLOPT_CUSTOMREQUEST] = $method;
        }

        if ($method === 'POST' || $method === 'PUT') {
            $opts[CURLOPT_POSTFIELDS] = json_encode($data);
        }

        if ($method === 'POST') {
            $opts[CURLOPT_POST] = 1;
        }

        curl_setopt_array($curl, $opts);
        // curl_setopt($curl, CURLOPT_VERBOSE, true);
        $response_body = curl_exec($curl);
        $response_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($response_code >= 300) {
            $this->throwError($response_body, $response_code);
        }

        return ['body' => json_decode($response_body, true), 'statusCode' => $response_code];
    }

    public function throwError($response_body, $response_code)
    {
        $error_message = json_decode($response_body)->error->message;
        switch ($response_code) {
            case 404:
                throw new NotFoundException($error_message, $response_code);
                break;

            case 409:
                throw new ConflictException($error_message, $response_code);
                break;

            default:
                throw new HttpException($error_message, $response_code);
                break;
        }
    }
}
