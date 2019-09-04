<?php

namespace DBerri\LaravelZoop\Entity;

use DBerri\LaravelZoop\Entity\AbstractEntity;

class Token extends AbstractEntity
{
    /**
     * @var string
     */
    public $resource = 'token';

    /**
     * Identificador único para este objeto
     *
     * @var string
     */
    public $id;

    /**
     * Indica se o token foi ou não utilizado. tokens podem ser
     * utilizados apenas 1 vez. Valor padrão: true
     *
     * @var boolean
     */
    public $used;

    /**
     * Data de criação do token no formato (yyyy-mm-ddThh:mm:ssZ)
     *
     * @var string
     */
    public $created_at;

    /**
     * Data da última atualização no formato (yyyy-mm-ddThh:mm:ssZ)
     *
     * @var string
     */
    public $updated_at;
}
