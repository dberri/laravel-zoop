<?php

namespace DBerri\LaravelZoop\Entity;

use DBerri\LaravelZoop\Entity\AbstractEntity;

class Source extends AbstractEntity
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string (reusable, single_use)
     */
    public $usage;

    /**
     * Valor em centavos a ser cobrado na venda (opcional)
     *
     * @var integer
     */
    public $amount;

    /**
     * Moeda do valor a ser cobrado na venda
     *
     * @var string
     */
    public $currency;

    /**
     * Descrição da venda quando gerada (opcional)
     *
     * @var string
     */
    public $description;

    /**
     * @var string  (wallet, card, card_and_wallet, token, customer, three_d_secure, debit_online)
     */
    public $type;

    /**
     * Capturar transação (true) ou criar uma pre-autorização (false) para ser capturada a posteriori
     *
     * @var integer
     */
    public $capture;

    /**
     * @var string
     */
    public $on_behalf_of;

    /**
     * ID referência da sua aplicação
     *
     * @var string VARCHAR(500)
     */
    public $reference_id;

    /**
     * objeto obrigatório no tipo card e card_and_wallet
     *
     * @var DBerri\LaravelZoop\Entity\AbstractEntity
     */
    public $card;

    public function setCard($card)
    {
        $this->card = new AbstractEntity($card);
    }
}
