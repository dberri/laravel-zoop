<?php

namespace DBerri\LaravelZoop\Entity;

use DBerri\LaravelZoop\Entity\AbstractEntity;

class Address extends AbstractEntity
{
    protected $required_properties = [
        'line1',
        'line2',
        'neighborhood',
        'city',
        'state',
        'postal_code',
        'country_code',
    ];

    /**
     * Endereço da pessoa.
     *
     * @var string
     */
    public $line1;

    /**
     * O número da rua permite que você identifique cada edifício em uma rua.
     *
     * @var string
     */
    public $line2;

    /**
     * Número do apartamento e outras informações.
     *
     * @var string
     */
    public $line3;

    /**
     * @var string
     */
    public $city;

    /**
     * Código ISO 3166-2 para o estado da pessoa
     *
     * @var string
     */
    public $state;

    /**
     * Bairro
     *
     * @var string
     */
    public $neighborhood;

    /**
     * Código postal da pessoa
     *
     * @var string
     */
    public $postal_code;

    /**
     * Código do país (BR)
     *
     * @var string
     */
    public $country_code = 'BR';
}
