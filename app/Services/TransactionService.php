<?php

namespace App\Services;

use App\Constants\Constants;
use App\Models\Transaction;

class TransactionService
{
    public function store($data)
    {
        $user = auth()->user();
        $transaction = new Transaction();
        $transaction->payer_id = $user->id;
"fkdslkldsfklsdkfldskflsdkflsdf"
        if (in_array($data['operation_type'], [Constants::TRANSACTION_OPERATION_TRANSFER])) {
            $transaction->fill($data);
            if ($user->account_type == Constants::USER_ACCOUNT_TYPE_SHOPKEEPER) {
                $transaction->status = Constants::TRANSACTION_STATUS_SHOPKEEPER_ID;
                $message = 'Operação não permitida para lojista';
            } else if ($user->id == $data['payee_id']) {
                $transaction->status = Constants::TRANSACTION_STATUS_SAME_TRANSFER_ACCOUNTS;
                $message = 'Conta de destino não pode ser a mesma que a atual';
            } else if (!$this->verifyPayerHasBalance($data)) {
                $transaction->status = Constants::TRANSACTION_STATUS_INSUFFICIENT_BALANCE;
                $transaction->payee_id = $data['payee_id'];
                $message = 'Saldo insuficiente para a transação!';
            } else if ($transaction->status == null) {
                $transaction->status = Constants::TRANSACTION_STATUS_SUCCESS;
                $transaction->save();
                return $transaction;
            }
            $transaction->save();
            throw new \Exception($message);
        }

        if (in_array($data['operation_type'], [Constants::TRANSACTION_OPERATION_WITHDRAWL]) && !$this->verifyPayerHasBalance($data)) {
            $transaction->fill($data);
            $transaction->status = Constants::TRANSACTION_STATUS_INSUFFICIENT_BALANCE;
            $transaction->save();
            throw new \Exception('Saldo insuficiente para o saque!');
        }

        if (in_array($data['operation_type'], [Constants::TRANSACTION_OPERATION_DEPOSIT])) {
            $transaction->payer_id = null;
            $transaction->payee_id = $data['payee_id'];
        }
        $transaction->status = Constants::TRANSACTION_STATUS_SUCCESS;
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
