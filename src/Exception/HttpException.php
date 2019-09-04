<?php

namespace DBerri\LaravelZoop\Exception;

class HttpException
{
    public $code;

    public $message;

    public function __construct($code, $body)
    {
        $this->code    = $code;
        $this->message = $body;
    }
}
