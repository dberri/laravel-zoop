<?php

namespace DBerri\LaravelZoop\Entity;

use DBerri\LaravelZoop\Entity\AbstractEntity;
use DBerri\LaravelZoop\Entity\Address;

class Seller extends AbstractEntity
{
    /**
     * @var string
     */
    public $resource = 'seller';

    /**
     * Identificador exclusivo para este vendedor
     *
     * @var string
     */
    public $id;

    /**
     * Um número de identificação do contribuinte é usado para registrar e acompanhar os pagamentos de impostos.
     *
     * @var string
     */
    public $taxpayer_id;

    /**
     * @var enum (individual, business)
     */
    public $type;

    /**
     * Uma string arbitrária que você pode anexar a um recurso de vendedor
     *
     * @var string
     */
    public $description;

    /**
     * Contém o primeiro nome do vendedor
     *
     * @var string
     */
    public $first_name;

    /**
     * Contém o sobrenome do vendedor
     *
     * @var string
     */
    public $last_name;

    /**
     * Endereço de e-mail deste vendedor
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
     * Um código de 4 dígitos designado por uma empresa de cartão
     * de crédito que lista o produto, serviço ou linha de negócios
     * de um comerciante.
     *
     * @var integer
     */
    public $mcc;

    /**
     * Data de nascimento do vendedor individual ou representante
     * do negócio. O formato é AAAA-MM, e. "1980-05"
     *
     * @var string
     */
    public $birthdate;

    /**
     * ID do Facebook ou nome de usuário do vendedor ou representante
     * do negócio.
     *
     * @var string
     */
    public $facebook;

    /**
     * ID do Twitter ou nome de usuário do vendedor ou representante
     * do negócio
     *
     * @var string
     */
    public $twitter;

    /**
     * CNPJ do Vendendor
     *
     * @var string
     */
    public $ein;

    /**
     * @var object
     */
    public $business_address;

    public $address;

    /**
     * O método de pagamento padrão (cartão ou conta bancária) associado
     * a um vendedor que será usado, por exemplo, para debitar a conta
     * bancária ou cartão de crédito
     *
     * @var string
     */
    public $default_debit;

    /**
     * O banco bancário padrão associado a um vendedor que será usado
     * para enviar dinheiro (crédito) a conta bancária
     *
     * @var string
     */
    public $default_credit;

    /**
     * Seja ou não o negócio móvel.
     *
     * @var boolean
     */
    public $is_mobile;

    /**
     * Pode publicar sua página para tornar a informação comercial
     * visível aos clientes on-line.
     *
     * @var string
     */
    public $show_profile_online;

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

    public $status;

    public $account_balance;

    public $current_balance;

    public $discal_responsibility;

    public $owner;

    public $business_name;

    public $business_phone;

    public $business_email;

    public $business_website;

    public $business_description;

    public $business_facebook;

    public $business_twitter;

    public $business_opening_date;

    public $delinquent;

    /**
     * Instancia o objeto Address e coloca na propriedade desta classe
     *
     * @param array $address
     */
    public function setAddress($address)
    {
        $this->address = new Address($address);
    }

    public function setBusinessAddress($address)
    {
        $this->business_address = new Address($address);
    }

    public function setOwner($owner)
    {
        $this->owner = new AbstractEntity($owner);
    }
}
