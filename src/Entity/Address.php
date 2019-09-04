<?php

namespace DBerri\LaravelZoop\Entity;

class Address extends AbstractEntity
{
    /**
     * Endereço da pessoa.
     *
     * @var string
     */
    public $linha1;

    /**
     * O número da rua permite que você identifique cada edifício em uma rua.
     *
     * @var string
     */
    public $linha2;

    /**
     * Número do apartamento e outras informações.
     *
     * @var string
     */
    public $linha3;

    /**
     * @var string
     */
    public $cidade;

    /**
     * Código ISO 3166-2 para o estado da pessoa
     *
     * @var string
     */
    public $estado;

    /**
     * Código postal da pessoa
     *
     * @var string
     */
    public $codigo_postal;
}
