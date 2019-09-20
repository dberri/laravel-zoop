<?php

namespace DBerri\LaravelZoop\Entity;

use DBerri\LaravelZoop\Entity\AbstractEntity;
use DBerri\LaravelZoop\Entity\PaymentMethod;
use DBerri\LaravelZoop\Entity\Source;

class Transaction extends AbstractEntity
{
    protected $required_properties = [
        'amount',
        'currency',
        'description',
        'payment_type',
        'on_behalf_of',
        'customer',
    ];

    public $id;

    /**
     * Valor em centavos a ser cobrado pela transação
     *
     * @var integer
     */
    public $amount;

    /**
     *
     *
     * @var string
     */
    public $currency = 'BRL';

    /**
     *
     *
     * @var string
     */
    public $description;

    /**
     *
     *
     * @var string (credit, debit, wallet, boleto)
     */
    public $payment_type;

    /**
     * Capturar transação (true) ou criar uma pre-autorização (false)
     * para ser capturada a posteriori
     *
     * @var boolean
     */
    public $capture;

    /**
     *
     *
     * @var string
     */
    public $on_behalf_of;

    /**
     * Nome do portador
     *
     * @var string
     */
    public $reference_id;

    /**
     * @var DBerri\LaravelZoop\Entity\PaymentMethod
     */
    public $payment_method;

    /**
     * @var DBerri\LaravelZoop\Entity\Source
     */
    public $source;

    /**
     * @var DBerri\LaravelZoop\Entity\AbstractEntity
     */
    public $installment_plan;

    /**
     * @var string
     */
    public $statement_descriptor;

    /**
     * Identificador do token de cartão que será cobrado
     *
     * @var string
     */
    public $token;

    /**
     * @var string
     */
    public $metadata;

    /**
     * @var string (Y-m-dTH:i:s+z)
     */
    public $expected_on;

    /**
     * $method é um array com:
     *   expiration_date  string    Data de vencimento do boleto
     *   top_instructions [string]  Instruções para o comprador utilizado nas vendas por boleto
     *
     * @param array $method
     */
    public function setPaymentMethod($method)
    {
        $this->payment_method = new PaymentMethod($method);
    }

    /**
     * @param array $source
     */
    public function setSource($source)
    {
        $this->source = new Source($source);
    }

    /**
     * $plan é um array com:
     *   mode                string    modo de parcelamento, com juros no emissor (with_interest),
     *                                 ou sem juros (interest_free), com o custo já calculado no
     *                                 valor da transação.
     *   number_installments integer   número de parcelas (1-10)
     *
     * @param array $method
     */
    public function setInstallmentPlan($plan)
    {
        $this->installment_plan = new AbstractEntity($plan);
    }

    public function setAmount($amount)
    {
        $this->amount = (int) str_replace('.', '', ((float) $amount));
    }
}
