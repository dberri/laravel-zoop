<?php

namespace DBerri\LaravelZoop\Entity;

use DBerri\LaravelZoop\Entity\AbstractEntity;

class BankAccount extends AbstractEntity
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $resource = 'bank_account';

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
     * Os últimos 4 dígitos da conta;
     *
     * @var string;
     */
    public $last4_digits;

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

    /**
     * O identificador do vendedor (seller) ou de um comprador (buyer)
     *
     * @var string
     */
    public $customer;

    /**
     * Indica se a conta está ou não ativada. Valor padrão: true
     *
     * @var boolean
     */
    public $is_active;

    /**
     * Indica se a conta está ou não ativada. Valor padrão: true
     *
     * @var boolean
     */
    public $is_verified;

    /**
     * Todos os objetos "bank_account" possuem um atributo "fingerprint"
     * que podem ser utilizados para identificar uma conta específica.
     *
     * @var string
     */
    public $fingerprint;

    /**
     * @var object
     */
    public $verification_setlist;

    /**
     * Se o CEP for fornecido, os possíveis valores são: pass, fail ou unchecked
     *
     * @var string
     */
    public $postal_code_check;

    /**
     * Você precisa validar uma conta zoop para debitar desta conta. Você não
     * precisará validar a conta para creditar nela. Os resultados são:
     * pass, fail ou unchecked
     *
     * @var string
     */
    public $deposit_check;

    /**
     * Se a linha 1 do endereço for fornecida, os resultados serão: pass, fail
     * ou unchecked
     *
     * @var string
     */
    public $address_line1_check;

    /**
     * Mapeamento de cheves (keys) de string e valores de caracteres. Key é o
     * identificador para os metadados (máximo de 30 caracteres). value é a
     * informação a ser armazenada como metadado.
     *
     * @var optional {"key": "value"} or null
     */
    public $metadata;

    /**
     * Data de criação no formato (yyyy-mm-ddThh:mm:ssZ)
     *
     * @var string
     */
    public $created_at;

    /**
     * Data de atualização no formato (yyyy-mm-ddThh:mm:ssZ)
     *
     * @var string
     */
    public $updated_at;
}
