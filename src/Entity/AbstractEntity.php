<?php

namespace DBerri\LaravelZoop\Entity;

class AbstractEntity
{
    /**
     * @param \stdClass|array|null  $parameters (optional)  Entity parameters
     */
    public function __construct($parameters = null)
    {
        if (!$parameters) {
            return;
        }

        if ($parameters instanceof \stdClass) {
            $parameters = get_object_vars($parameters);
        }

        $this->build($parameters);
    }

    /**
     * Preenche entidade com os parametros
     *
     * @param array  $parameters  Entity parameters
     */
    public function build(array $parameters)
    {
        foreach ($parameters as $property => $value) {
            $this->$property = $value;

            $mutator = 'set' . ucFirst(static::convertToCamelCase($property));
            if (method_exists($this, $mutator)) {
                call_user_func_array([$this, $mutator], [$value]);
            }
        }
    }

    /**
     * Converte entidade para um array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }

    /**
     * Converte string para camelCase
     *
     * @param  string  $str  snake_case string
     * @return string  CamelCase string
     */
    protected static function convertToCamelCase($str)
    {
        $callback = function ($match) {
            return strtoupper($match[2]);
        };

        return lcfirst(preg_replace_callback('/(^|_)([a-z])/', $callback, $str));
    }
}
