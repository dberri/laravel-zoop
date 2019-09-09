<?php

namespace DBerri\LaravelZoop\API;

use DBerri\LaravelZoop\API\AbstractApi;
use DBerri\LaravelZoop\Entity\Buyer;

class BuyerApi extends AbstractApi
{
    /**
     * Lista os compradores do marketplace
     *
     * @param array $params Array com parâmetros query
     */
    public function getAll($params = [])
    {
        $response = $this->adapter->get('/buyers', $params);
        return Buyer::makeCollection($response['body']['items']);
    }

    /**
     * Recupera detalhes de comprador pelo id
     *
     * @param string $id
     */
    public function getById($id)
    {
        $url      = '/buyers/' . $id;
        $response = $this->adapter->get($url);
        return new Buyer($response['body']);
    }

    /**
     * Busca de comprador por CPF/CNPJ
     *
     * @param string $taxpayer_id CPF
     * @param string $ein CNPJ
     */
    public function search($taxpayer_id = '', $ein = '')
    {
        $response = $this->adapter->get('/buyers/search', compact('taxpayer_id', 'ein'));
        return new Buyer($response['body']);
    }

    /**
     * Criar novo comprador do tipo indivíduo
     *
     * @param DBerri\LaravelZoop\Entity\BuyerEntity $buyer
     */
    public function create(Buyer $buyer)
    {
        $response = $this->adapter->post('/buyers', $buyer->toArray());
        return new Buyer($response['body']);
    }

    /**
     * Altera comprador do tipo indivíduo
     *
     * @param DBerri\LaravelZoop\Entity\BuyerEntity $buyer
     */
    public function update(Buyer $buyer)
    {
        $url      = '/buyers/' . $buyer->id;
        $response = $this->adapter->put($url, $buyer->toArray());
        return new Buyer($response['body']);
    }

    /**
     * Deleta um comprador pelo id
     *
     * @param string $id
     */
    public function delete($id)
    {
        $url      = '/buyers/' . $id;
        $response = $this->adapter->delete($url);
        return $response['statusCode'] === 200;
    }

    /**
     * Lista contas por comprador
     *
     * @param string $id
     */
    public function getBills($id)
    {
        $url      = sprintf('/buyers/%s/balances', $id);
        $response = $this->adapter->get($url);
        return $response['body'];
    }

    /**
     * Listar histórico de lançamentos de conta por comprador
     *
     * @param string $id
     */
    public function getBillsHistory($id)
    {
        $url      = sprintf('/buyers/%s/balances/history', $id);
        $response = $this->adapter->get($url);
        return $response['body'];
    }
}
