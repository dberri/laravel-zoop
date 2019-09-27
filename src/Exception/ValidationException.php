<?php

namespace DBerri\LaravelZoop\Exception;

class ValidationException extends \Exception
{
    public $reasons;

    public function __construct($error_message, $reponse_code, $reasons)
    {
        parent::__construct('Os dados informados são inválidos.', $reponse_code);

        $this->reasons = $reasons;
    }

    public function getErrors()
    {
        return $this->reasons;
    }
}
