<?php

namespace DBerri\LaravelZoop\Entity;

use DBerri\LaravelZoop\Entity\AbstractEntity;

class SplitTransaction extends AbstractEntity
{
    protected $required_properties = [
        'amount',
    ];

    /**
     * id do vendedor recebedor
     *
     * @var string
     */
    public $recipient;

    /**
     * Define se o recebedor arca com prejuízo em
     * caso de chargeback ou não. 1 arca; 0 não arca.
     *
     * @var boolean
     */
    public $liable = 1;

    /**
     * Define se vai ser feito split em cima do valor
     * bruto (0) ou do valor líquido (1) da transação
     *
     * @var boolean
     */
    public $charge_processing_fee;

    /**
     * Percentual da venda a ser dividido
     *
     * @var integer
     */
    public $percentage;

    /**
     * Valor em centavos a ser divido
     *
     * @var integer
     */
    public $amount;
}
