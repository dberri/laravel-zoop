<?php

namespace DBerri\LaravelZoop\Entity;

use DBerri\LaravelZoop\Entity\AbstractEntity;

class PaymentMethod extends AbstractEntity
{
    /**
     * @var string "YYYY-MM-DD"
     */
    public $expiration_date;

    /**
     * @var string
     */
    public $payment_limit_date;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $reference_number;

    /**
     * @var string
     */
    public $document_number;

    /**
     * @var string
     */
    public $sequence;

    /**
     * @var string
     */
    public $url;

    /**
     * @var boolean
     */
    public $accepted;

    /**
     * @var boolean
     */
    public $printed;

    /**
     * @var boolean
     */
    public $downloaded;

    /**
     * @var string
     */
    public $barcode;

    /**
     * @var string
     */
    public $status;

    /**
     * @var array
     */
    public $body_instructions;

    /**
     * @var array
     */
    public $billing_instructions;

    /**
     * O array dados pode ter três chaves: late_fee (multa), interest (juros) e discount (desconto)
     * late_fee e interest contêm `mode` (FIXED ou DAILY_AMOUNT) e `amount` (valor)
     *
     * @param array $dados
     */
    public function setBillingInstructions($dados)
    {
        $this->billing_instructions = json_decode(json_encode($dados));
    }
}
