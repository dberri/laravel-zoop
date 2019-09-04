<?php

namespace DBerri\LaravelZoop\Entity;

use DBerri\LaravelZoop\Entity\AbstractEntity;

class Buyer extends AbstractEntity
{
    /**
     * @var string
     */
    public $resource = 'buyer';

    /**
     * Identificador exclusivo para este comprador
     *
     * @var string
     */
    public $id;

    /**
     * Campo livre contendo a descrição do comprador
     *
     * @var string
     */
    public $description;

    /**
     * Contém o primeiro nome do comprador
     *
     * @var string
     */
    public $first_name;

    /**
     * Contém o sobrenome do comprador
     *
     * @var string
     */
    public $last_name;

    /**
     * CPF ou CNPJ do comprador
     *
     * @var string
     */
    public $taxpayer_id;

    /**
     * Endereço de e-mail deste comprador
     *
     * @var string
     */
    public $email;

    /**
     * Formatação do número E.164 para o telefone do vendedor.
     * Os números E.164 podem ter um máximo de quinze dígitos
     * e geralmente são escritos da seguinte forma:
     * [+][código do país] [número do assinante, incluindo o código de área].
     *
     * @var string
     */
    public $phone_number;

    /**
     * Data de nascimento do comprador
     * do negócio. O formato é AAAA-MM, e. "1980-05"
     *
     * @var string
     */
    public $birthdate;

    /**
     * ID do Facebook do comprador
     *
     * @var string
     */
    public $facebook;

    /**
     * ID do Twitter do comprador
     *
     * @var string
     */
    public $twitter;

    /**
     * Indica se o comprador gostaria ou não de receber
     * emails. Valor padrão: false
     *
     * @var boolean
     */
    public $email_optin;

    /**
     * Indica se o comprador gostaria ou não de receber
     * SMSs. Valor padrão: false
     *
     * @var boolean
     */
    public $sms_optin;

    /**
     * Método padrão para o envio de recibos de compras (email ou SMS).
     *
     * @var enum (sms, email)
     */
    public $default_receipt_delivery_method;

    /**
     * @var object
     */
    public $address;

    /**
     * Objeto "card" ou "bankaccount"
     *
     * @var list
     */
    public $payment_methods;

    /**
     * Método padrão para pagamento atribuído ao comprador que será
     * utilizado para debitar da conta ou do cartão de débito.
     *
     * @var string
     */
    public $defalt_debit;

    /**
     * Método padrão para pagamento atribuído ao comprador que será
     * utilizado para debitar da conta ou do cartão de crédito.
     *
     * @var string
     */
    public $default_credit;

    /**
     * Mapeamento de chaves de string para valores de sequência de caracteres.
     * key (Chave) é o identificador para os metadados (máximo de 30 caracteres).
     * value (valor) é a informação a ser armazenada como metadados.
     *
     * @var optional {"key": "value"} or null
     */
    public $metadata;

    /**
     * W3C Datetime Format para a criação da data (yyyy-mm-ddThh:mm:ssZ)
     *
     * @var string
     */
    public $created_at;

    /**
     * W3C Datetime Format para a última atualização (yyyy-mm-ddThh:mm:ssZ)
     *
     * @var string
     */
    public $updated_at;
}
