<?php

namespace App\Services;

use App\Api\ApiMessages;
use App\Constants\Constants;
use App\Models\Transaction;
use App\Models\User;

class TransactionService {

    public function store($data)
    {
        $user = auth()->user();
        $transaction = new Transaction();

        if (in_array($data['operation_type'], [Constants::TRANSACTION_OPERATION_WITHDRAWL, Constants::TRANSACTION_OPERATION_TRANSFER]) && !$this->verifyPayerHasBalance($data)) {
            throw new \Exception('Saldo insuficiente');
        } else {
            $transaction->payer_id = $user->id;
        }

        if (in_array($data['operation_type'], [Constants::TRANSACTION_OPERATION_DEPOSIT])) {
            $transaction->payee_id = $data['payee_id'];
            $transaction->payer_id = null;
        }

        $transaction->fill($data);
        $transaction->save();
        return $transaction;
    }

    public function verifyPayerHasBalance($data)
    {
        $user = auth()->user();
        return $user->getBalance() >= $data['value'];


    }
}
