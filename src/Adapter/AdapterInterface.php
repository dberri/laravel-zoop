<?php

namespace DBerri\LaravelZoop\Adapter;

use DBerri\LaravelZoop\Exception\HttpException;

interface AdapterInterface
{
    /**
     * GET Request
     *
     * @param  string $url
     * @throws HttpException
     * @return string
     */
    public function get($url);

    /**
     * POST Request
     *
     * @param  string $url
     * @param  mixed $content
     * @throws HttpException
     * @return string
     */
    public function post($url, $content = '');

    /**
     * PUT Request
     *
     * @param  string $url
     * @param  mixed $content
     * @throws HttpException
     * @return string
     */
    public function put($url, $content = '');

    /**
     * DELETE Request
     *
     * @param  string $url
     * @throws HttpException
     * @return string
     */
    public function delete($url);
}
