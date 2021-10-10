<?php

namespace App\Http\Controllers;

use App\Api\ApiMessages;
use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use App\Services\ExternalService;
use App\Services\TransactionService;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\TransactionException;

class TransactionController extends Controller
{
    public function store(TransactionRequest $request)
    {
        //DB::beginTransaction();
        try {
            $transactionService = new TransactionService();
            $transaction = $transactionService->store($request->all());
            $externalServices = new ExternalService();
            $externalServices->validateMock($transaction);
            return $this->showOne($transaction, 201);
        } catch (\Exception $e) {
            //DB::rollBack();


            //$model = new Transaction();
            //$model->fill($transaction);
            //$model->save();
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 422);
        } finally {
            //DB::commit();
        }
    }
}
