<?php

namespace DBerri\LaravelZoop\API;

use DBerri\LaravelZoop\API\AbstractApi;
use DBerri\LaravelZoop\Entity\SplitTransaction;
use DBerri\LaravelZoop\Entity\Transaction;

class TransactionApi extends AbstractApi
{
    /**
     * Lista as transações do marketplace
     *
     * @param array $params Array com parâmetros query
     */
    public function getAll($params = [])
    {
        $response = $this->adapter->get('/transactions', $params);
        return Transaction::makeCollection($response['body']['items']);
    }

    /**
     * Recuperar detalhes de transação pelo id
     *
     * @param string $id
     */
    public function getById($id)
    {
        $url      = sprintf('/transactions/%s', $id);
        $response = $this->adapter->get($url);
        return new Transaction($response['body']);
    }

    /**
     * Cria nova transação
     *
     * @param DBerri\LaravelZoop\Entity\Transaction $transaction
     */
    public function create(Transaction $transaction)
    {
        $response = $this->adapter->post('/transactions', $transaction->toArray());
        return new Transaction($response['body']);
    }

    /**
     * Atualiza uma transação
     *
     * @param DBerri\LaravelZoop\Entity\Transaction $transaction
     */
    public function update(Transaction $transaction)
    {
        $url    = sprintf('/transactions/%s', $transaction->id);
        $params = [
            "description" => $transaction->description,
            "metadata"    => $transaction->metadata,
        ];
        $response = $this->adapter->put($url, $params);
        return new Transaction($response['body']);
    }

    /**
     * Estorna transação
     *
     * @param string  $id
     * @param string  $on_behalf_of  id do seller responsavel pela venda
     * @param integer $amount        valor da venda a ser estornado em centavos
     */
    public function void($id, $on_behalf_of, $amount)
    {
        $url      = sprintf('/transactions/%s/void', $id);
        $response = $this->adapter->post($url, compact('on_behalf_of', 'amount'));
        return new Transaction($response['body']);
    }

    /**
     * Captura transação
     *
     * @param string  $id
     * @param string  $on_behalf_of  id do seller responsavel pela venda
     * @param integer $amount        valor da venda a ser estornado em centavos
     */
    public function capture($id, $on_behalf_of, $amount)
    {
        $url      = sprintf('/transactions/%s/capture', $transaction->id);
        $response = $this->adapter->post($url, compact('on_behalf_of', 'amount'));
        return new Transaction($response['body']);
    }

    /**
     * Recuperar detalhes de regra de divisão por transação
     *
     * @param string $transaction_id
     */
    public function getSplitTransactions($transaction_id)
    {
        $url      = sprintf('/transactions/%s/split_rules', $transaction_id);
        $response = $this->adapter->get($url);
        // !TODO: Checar se não retorna array
        return isset($response['body']['id']) ? new SplitTransaction($response['body']) : null;
    }

    /**
     * Recuperar detalhes de regra de divisão por id
     *
     * @param string $transaction_id
     */
    public function getSplitTransactionById($transaction_id, $id)
    {
        $url      = sprintf('/transactions/%s/split_rules/%s', $transaction_id, $id);
        $response = $this->adapter->get($url);
        return isset($response['body']['id']) ? new SplitTransaction($response['body']) : null;
    }

    /**
     * Criar regra de divisão por transação
     *
     * @param string                                      $transaction_id
     * @param DBerri\LaravelZoop\Entity\SplitTransaction  $split_transaction
     */
    public function createSplitTransaction($transaction_id, SplitTransaction $split_transaction)
    {
        $url      = sprintf('/transaction/%s/split_rules', $transaction_id);
        $response = $this->adapter->post($url, $split_transaction->toArray());
        return new SplitTransaction($response['body']);
    }

    /**
     * Criar regra de divisão por transação
     *
     * @param string                                      $transaction_id
     * @param DBerri\LaravelZoop\Entity\SplitTransaction  $split_transaction
     */
    public function updateSplitTransaction($transaction_id, SplitTransaction $split_transaction)
    {
        $url      = sprintf('/transaction/%s/split_rules/%s', $transaction_id, $split_transaction->id);
        $response = $this->adapter->put($url, $split_transaction->toArray());
        return new SplitTransaction($response['body']);
    }

    /**
     * Criar regra de divisão por transação
     *
     * @param  string  $transaction_id
     * @param  string  $split_transaction_id
     */
    public function deleteSplitTransaction($transaction_id, $split_transaction_id)
    {
        $url      = sprintf('/transaction/%s/split_rules/%s', $transaction_id, $split_transaction_id);
        $response = $this->adapter->delete($url);
        return $response['body'];
    }
}
