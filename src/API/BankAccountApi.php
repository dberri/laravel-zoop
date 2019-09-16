<?php

namespace DBerri\LaravelZoop\API;

use DBerri\LaravelZoop\API\AbstractApi;
use DBerri\LaravelZoop\Entity\BankAccount;
use DBerri\LaravelZoop\Entity\Transfer;

class BankAccountApi extends AbstractApi
{
    /**
     * Lista todas as contas bancárias do marketplace
     */
    public function getAll()
    {
        $response = $this->adapter->get('/bank_accounts');
        return BankAccount::makeCollection($response['body']['items']);
    }

    /**
     * Recupera detalhes de conta bancária por identificador
     *
     * @param string $id
     */
    public function getById($id)
    {
        $url      = sprintf('/bank_accounts/%s', $id);
        $response = $this->adapter->get($url);
        return new BankAccount($response['body']);
    }

    /**
     * Associa conta bancaria com customer
     *
     * @param string $customer
     * @param string $token
     */
    public function create($customer, $token)
    {
        $response = $this->adapter->post('/bank_accounts', compact('customer', 'token'));
        return new BankAccount($response['body']);
    }

    /**
     * Altera detalhes de conta bancária
     *
     * @param DBerri\LaravelZoop\API\Entity\BankAccount $bank_account
     */
    public function update(BankAccount $bank_account)
    {
        $url      = sprintf('/bank_accounts/%s', $bank_account->id);
        $response = $this->adapter->put($url, $bank_account->toArray());
        return new BankAccount($response['body']);
    }

    /**
     * Remove conta bancaria
     *
     * @param string $id
     */
    public function delete($id)
    {
        $url      = sprintf('/bank_accounts/%s', $id);
        $response = $this->adapter->delete($url);
        return $response['statusCode'] === 200;
    }

    /**
     * Cria transferência para conta bancária
     *
     * @param string $bank_account_id
     * @param string DBerri\LaravelZoop\API\Entity\Transfer $transfer
     */
    public function createTransfer($bank_account_id, Transfer $transfer)
    {
        $url      = sprintf('/bank_accounts/%s/transfers', $bank_account_id);
        $response = $this->adapter->post($url, $transfer->toArray());
        return new Transfer($response['body']);
    }
}
