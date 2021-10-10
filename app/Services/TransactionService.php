<?php

namespace App\Services;

use App\Constants\Constants;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    //$data recebe valores da request
    public function store($data)
    {
        DB::beginTransaction();
        $user = auth()->user();
        $transaction = new Transaction();

//        if (in_array($data['operation_type'],[Constants::TRANSACTION_OPERATION_TRANSFER])){
//            if($user->account_type == Constants::USER_ACCOUNT_TYPE_SHOPKEEPER) {
//                $transaction->status = Constants::TRANSACTION_STATUS_SHOPKEEPER_ID;
//                throw new \Exception('Operação não permitida para lojista');
//            } else if($user->id == $data['payee_id']) {
//                $transaction->status = Constants::TRANSACTION_STATUS_SAME_TRANSFER_ACCOUNTS;
//                throw new \Exception('Conta de destino não pode ser a mesma que a atual');
//            }
//        }

        if (in_array($data['operation_type'], [Constants::TRANSACTION_OPERATION_WITHDRAWL, Constants::TRANSACTION_OPERATION_TRANSFER]) && !$this->verifyPayerHasBalance($data)) {
            $transaction->payer_id = $user->id;
            $transaction->status = Constants::TRANSACTION_STATUS_INSUFFICIENT_BALANCE;
            $transaction->fill($data);

            throw new \Exception('Saldo insuficiente!');
        } else {
            $transaction->payer_id = $user->id;
            $transaction->payee_id = null;
        }

        if (in_array($data['operation_type'], [Constants::TRANSACTION_OPERATION_DEPOSIT])) {
            $transaction->payee_id = $data['payee_id'];
            $transaction->payer_id = null;
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
