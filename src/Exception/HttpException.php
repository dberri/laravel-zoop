<?php

namespace DBerri\LaravelZoop\Exception;

class HttpException extends \Exception
{
    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
