<?php

namespace DBerri\LaravelZoop\Exception;

use DBerri\LaravelZoop\Exception\ConflictException;
use DBerri\LaravelZoop\Exception\NotFoundException;

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

        switch ($this->code) {
            case '404':
                throw new NotFoundException($this->code, $this->message);
                break;

            case '409':
                throw new ConflictException($this->code, $this->message);
                break;

            default:
                break;
        }
    }
}
