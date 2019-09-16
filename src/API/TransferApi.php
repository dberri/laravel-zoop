<?php

namespace DBerri\LaravelZoop\API;

use DBerri\LaravelZoop\API\AbstractApi;
use DBerri\LaravelZoop\Entity\Transfer;

class TransferApi extends AbstractApi
{
    /**
     * Lista todas as transferências do marketplace
     */
    public function getAll()
    {
        $response = $this->adapter->get('/transfers');
        return Transfer::makeCollection($response['body']['items']);
    }

    /**
     * Recuperar detalhes da transferência
     *
     * @var string $id
     */
    public function getById($id)
    {
        $url      = sprintf('/transfers/%s', $id);
        $response = $this->adapter->get($url);
        return new Transfer($response['body']);
    }

    /**
     * Cancela transferência agendada anteriormente à
     * data prevista para efetivação
     *
     * @var string $id
     */
    public function cancel($id)
    {
        $url      = sprintf('/transfers/%s', $id);
        $response = $this->adapter->delete($url);
        return $response['statusCode'] === 200;
    }

    /**
     * Lista transações associadas a transferência
     *
     * @var string $id
     */
    public function getTransactions($id)
    {
        $url      = sprintf('/transfers/%s/transactions', $id);
        $response = $this->adapter->get($url);
        return Transfer::makeCollection($response['body']['items']);
    }

    /**
     * Lista transações associadas a transferência
     *
     * @param string $owner    identificador do customer pagador
     * @param string $receiver identificador do customer recebedor
     * @param array  $params   array com `amount`, `description` e `transfer_date`
     */
    public function peer2peer($owner, $receiver, $params = [])
    {
        $url      = sprintf('/transfers/%s/to/%s', $owner, $receiver);
        $response = $this->adapter->post($url, $params);
        return $response['body'];
    }
}
