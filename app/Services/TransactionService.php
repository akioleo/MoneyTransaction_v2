<?php

namespace App\Services;

use App\Api\ApiMessages;
use App\Constants\Constants;
use App\Models\Transaction;
use App\Models\User;

class TransactionService {
    //$data recebe valores da request
    public function store($data)
    {
        $user = auth()->user();
        $transaction = new Transaction();

        if (in_array($data['operation_type'], [Constants::TRANSACTION_OPERATION_WITHDRAWL, Constants::TRANSACTION_OPERATION_TRANSFER]) && !$this->verifyPayerHasBalance($data)) {
            $transaction->payer_id = $user->id;
            throw new \Exception('Saldo insuficiente');
        } else {
            $transaction->payer_id = $user->id;
        }

        if (in_array($data['operation_type'], [Constants::TRANSACTION_OPERATION_DEPOSIT])) {
            $transaction->payer_id = null;
            $transaction->payee_id = $data['payee_id'];
        }


        $transaction->status = Constants::TRANSACTION_STATUS_SUCCESS;
        //fill preenche a transaction com dados da request
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
