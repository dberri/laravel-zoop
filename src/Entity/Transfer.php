<?php

namespace DBerri\LaravelZoop\Entity;

use DBerri\LaravelZoop\Entity\AbstractEntity;

class Transfer extends AbstractEntity
{
    /**
     * Identificador exclusivo para esta transferência
     *
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $resource = 'transfer';

    /**
     * (new, pending, succeeded, failed, delayed, expired)
     * Indica o estado atual desta transferência, por exemplo:
     * "Bem-sucedido" (succeeded) significa que o dinheiro é
     * transferido com sucesso.
     *
     * Novo (new)           A transferência foi criada pelo aplicativo.
     * Pendente (pending)   As informações de transferência foram recebidas com sucesso para processamento.
     * succeeded            O pagamento foi creditado na conta do beneficiário.
     * Falhou (failed)      A transferência falhou.
     * Atrasado (delayed)   A transferência de fundos foi adiada.
     * Expiradas (expired)  As transferências expiram se ainda estiverem em estado após 30 minutos.
     *
     * @var enum
     */
    public $status;

    /**
     * Um identificador exclusivo de um vendedor (seller) ou um
     * objeto comprador (buyer). Os destinatários representam
     * vendedores ou compradores dentro do seu mercado.
     *
     * @var string
     */
    public $recipient;

    /**
     * Um número inteiro positivo em centavos que representa o
     * quanto de carga, p. "1260" por US $ 12,60
     *
     * @var integer > 0
     */
    public $amount;

    /**
     * Um número inteiro positivo em centavos
     *
     * @var integer
     */
    public $original_amount;

    /**
     * ISO 4217 Código de moeda formatado
     *
     * @var string
     */
    public $currency;

    /**
     * Uma seqüência arbitrária que você pode anexar a um
     * objeto de transferência
     *
     * @var string
     */
    public $description;

    /**
     * Este é o número de transferência que aparece nos
     * recibos de e-mail enviados para esta venda.
     *
     * @var string
     */
    public $transfer_number;

    /**
     * Um "descritor de declaração - statemente descriptor"
     * é o valor que seus clientes verão no extrato bancário.
     *
     * @var string
     */
    public $statement_descriptor;

    /**
     * Um bankaccount válido deve ser um token não utilizado
     * ou um ID exclusivo.
     *
     * @var string
     */
    public $bank_account;

    /**
     * A latitude em que ocorreu a transação
     *
     * @var float
     */
    public $location_latitude;

    /**
     * A longitude onde ocorreu a transação
     *
     * @var float
     */
    public $location_longitude;

    /**
     * Mapeamento de chaves de string para valores de sequência de
     * caracteres. Chave (key) é o identificador para as metadadas
     * (máximo de 30 caracteres). O valor (value) é a informação a
     * ser armazenada como metadados.
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
     * W3C Datetime Format para a criação da data (yyyy-mm-ddThh:mm:ssZ)
     *
     * @var string
     */
    public $updated_at;
}
