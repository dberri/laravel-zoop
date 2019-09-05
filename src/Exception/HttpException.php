<?php

namespace DBerri\LaravelZoop\Exception;

class HttpException extends \Exception
{
    /**
     * HTTP Status Code
     *
     * @var number
     */
    protected $code;

    /**
     * Error message
     *
     * @var string
     */
    protected $message;

    public function __construct($code, $body)
    {
        $this->code    = $code;
        $this->message = $body;
    }
}
