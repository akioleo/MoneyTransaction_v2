<?php

namespace App\Http\Controllers\Admin;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminTransactionRequest;
use App\Models\Transaction;

class AdminTransactionsController extends Controller
{
    private $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function index()
    {
        try {
            $transactions = $this->transaction->paginate('10');
            return response()->json([
                'data' => $transactions,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['data' => ['message' => 'Transação não encontrada']], 404);
        }
    }

    public function show($transaction)
    {
        try {
            $transactions = $this->transaction->whereId($transaction)->findOrFail($transaction);
            return response()->json([
                'data' => $transactions
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['data' => ['message' => 'Transação não encontrada']], 404);
        }
    }

    public function store(AdminTransactionRequest $request)
    {
        $data = $request->all();
        try {
            $transactions = $this->transaction->create($data);

            return response()->json([
                'data' => [
                    'msg' => 'Transação cadastrada com sucesso!'
                ]
            ], 200);
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 400);
        }
    }

    public function update($transaction, AdminTransactionRequest $request)
    {
        $data = $request->all();

        try {

            $transactions = $this->transaction->whereId($transaction)->findOrFail($transaction);
            $transactions->update($data);

            return response()->json([
                'data' => [
                    'msg' => 'Transação alterada com sucesso!'
                ]
            ], 200);
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 404);
        }
    }

    public function destroy($transaction)
    {
        try {
            $transactions = $this->transaction->whereId($transaction)->findOrFail($transaction);
            $transactions->delete();

            return response()->json([
                'data' => [
                    'msg' => 'Transação removida com sucesso!'
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['data' => ['message' => 'Transação não encontrada']], 404);
        }
    }
}
