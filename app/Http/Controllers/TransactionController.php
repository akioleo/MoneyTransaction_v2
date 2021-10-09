<?php

namespace App\Http\Controllers;

use App\Api\ApiMessages;
use App\Http\Requests\TransactionRequest;
use App\Services\TransactionService;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function store(TransactionRequest $request)
    {
        try {
            $transactionService = new TransactionService();
            $transaction = $transactionService->store($request->all());
            return $this->showOne($transaction, 201);
            //return $this->showOne($transaction, 201, TransactionTransformer::class);
        } catch (\Exception $e){
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 422);
        }
    }
}
