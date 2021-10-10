<?php

namespace App\Transformers;

use App\Models\Transaction;
use League\Fractal\TransformerAbstract;

class TransactionTransformer extends TransformerAbstract
{

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Transaction $transaction)
    {
        return [
            'id' => (int) $transaction->id,
            'value' => (float) $transaction->value,
            'payee_id' => (int) $transaction->payee_id,
            'payer_id' => (int) $transaction->payer_id,
            'status' => (string) $transaction->status,
            'operation_type' => (string) $transaction->operation_type,
            'payee' => $transaction->payee ? $transaction->payee->transform() : null,
            'payer' => $transaction->payer ? $transaction->payer->transform() : null,
            'date_now' => now()
        ];
    }
}
