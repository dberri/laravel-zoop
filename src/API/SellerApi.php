<?php

namespace DBerri\LaravelZoop\API;

use DBerri\LaravelZoop\API\AbstractApi;
use DBerri\LaravelZoop\Entity\BankAccount;
use DBerri\LaravelZoop\Entity\Seller;
use DBerri\LaravelZoop\Entity\Transaction;
use DBerri\LaravelZoop\Entity\Transfer;

class SellerApi extends AbstractApi
{
    /**
     * Lista os vendedores do marketplace
     *
     * @param array $params Array com parâmetros query
     */
    public function getAll($params = [])
    {
        $response = $this->adapter->get('/sellers', $params);
        return Seller::makeCollection($response['body']['items']);
    }

    /**
     * Recupera detalhes de vendedor pelo id
     *
     * @param string $id
     */
    public function getById($id)
    {
        $url      = '/sellers/' . $id;
        $response = $this->adapter->get($url);
        return new Seller($response['body']);
    }

    /**
     * Busca de vendedor por CPF/CNPJ
     *
     * @param string $taxpayer_id CPF
     * @param string $ein CNPJ
     */
    public function search($taxpayer_id = '', $ein = '')
    {
        $response = $this->adapter->get('/selers/search', compact('taxpayer_id', 'ein'));
        return new Seller($response['body']);
    }

    /**
     * Criar novo vendedor do tipo indivíduo
     *
     * @param DBerri\LaravelZoop\Entity\SellerEntity $seller
     */
    public function createIndividual(Seller $seller)
    {
        $response = $this->adapter->post('/sellers/individuals', $seller->toArray());
        return new Seller($response['body']);
    }

    /**
     * Criar novo vendedor do tipo empresa
     *
     * @param DBerri\LaravelZoop\Entity\SellerEntity $seller
     */
    public function createBusiness(Seller $seller)
    {
        $response = $this->adapter->post('/sellers/businesses', $seller->toArray());
        return new Seller($response['body']);
    }

    /**
     * Altera vendedor do tipo indivíduo
     *
     * @param DBerri\LaravelZoop\Entity\SellerEntity $seller
     */
    public function updateIndividual(Seller $seller)
    {
        $url      = '/sellers/individuals/' . $seller->id;
        $response = $this->adapter->put($url, $seller->toArray());
        return new Seller($response['body']);
    }

    /**
     * Altera vendedor do tipo empresa
     *
     * @param DBerri\LaravelZoop\Entity\SellerEntity $seller
     */
    public function updateBusiness(Seller $seller)
    {
        $url      = '/sellers/businesses/' . $seller->id;
        $response = $this->adapter->put($url, $seller->toArray());
        return new Seller($response['body']);
    }

    /**
     * Deleta um vendedor pelo id
     *
     * @param string $id
     */
    public function delete($id)
    {
        $url      = '/sellers/' . $id;
        $response = $this->adapter->delete($url);
        return $response['statusCode'] === 200;
    }

    /**
     * Recupera o saldo corrente e saldo total de conta
     *
     * @param string $id
     */
    public function getBalance($id)
    {
        $url      = sprintf('/sellers/%s/balances', $id);
        $response = $this->adapter->get($url);
        return $response['body'];
    }

    /**
     * Lista contas por vendedor
     *
     * @param string $id
     */
    public function getBills($id)
    {
        $url      = sprintf('/sellers/%s/balances/all', $id);
        $response = $this->adapter->get($url);
        return $response['body'];
    }

    /**
     * Lista histórico de lançamentos de conta por vendedor
     *
     * @param string $id
     */
    public function getBillsHistory($id)
    {
        $url      = sprintf('/sellers/%s/balances/history', $id);
        $response = $this->adapter->get($url);
        return $response['body'];
    }

    /**
     * Lista as transações do vendedor
     *
     * @param string $id
     */
    public function getTransactions($id, $params = [])
    {
        $url      = sprintf('/sellers/%s/transactions', $id);
        $response = $this->adapter->get($url, $params);
        return Transaction::makeCollection($response['body']['items']);
    }

    /**
     * Lista as contas bancarias do vendedor
     *
     * @param string $id
     */
    public function getTransactions($id, $params = [])
    {
        $url      = sprintf('/sellers/%s/bank_accounts', $id);
        $response = $this->adapter->get($url, $params);
        return BankAccount::makeCollection($response['body']['items']);
    }

    /**
     * Lista as trasnferências do vendedor
     *
     * @param string $id
     */
    public function getTransfers($id)
    {
        $url      = sprintf('/sellers/%s/transfers', $id);
        $response = $this->adapter->get($url);
        return Transfer::makeCollection($response['body']['items']);
    }
}
