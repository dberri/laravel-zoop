<?php

namespace DBerri\LaravelZoop\API;

use DBerri\LaravelZoop\API\AbstractApi;
use DBerri\LaravelZoop\Entity\BankAccount;
use DBerri\LaravelZoop\Entity\Token;

class TokenApi extends AbstractApi
{
    /**
     * Associa conta bancaria com customer
     *
     * @param string $customer
     * @param string $token
     */
    public function createCardToken($customer, $token)
    {
        return null;
        // $response = $this->adapter->post('/bank_accounts', compact('customer', 'token'));
        // return new BankAccount($response['body']);
    }

    /**
     * Associa conta bancaria com customer
     *
     * @param BankAccount $bankAccount
     */
    public function createBankAccount(BankAccount $bankAccount)
    {
        $response = $this->adapter->post('/bank_accounts/tokens', $bankAccount->toArray());
        return new Token($response['body']);
    }
}
