<?php

namespace DBerri\LaravelZoop\Entity;

use DBerri\LaravelZoop\Entity\AbstractEntity;

class ContaBancaria extends AbstractEntity
{
    /**
     * Nome do portador
     *
     * @var string
     */
    public $holder_name;

    /**
     * Nome do portador
     *
     * @var number|float
     */
    public $bank_code;

    /**
     * Agencia sem DV (4 digitos)
     *
     * @var number|float
     */
    public $routing_number;

    /**
     * Conta Bancaria com DV
     *
     * @var number|float
     */
    public $account_number;

    /**
     * CPF, caso seller seja PF
     *
     * @var string
     */
    public $taxpayer_id;

    /**
     * CNPJ, caso seller seja PJ
     *
     * @var string
     */
    public $ein;

    /**
     * Conta corrente ou poupança
     *
     * @var string (checking, savings)
     */
    public $type;
}
