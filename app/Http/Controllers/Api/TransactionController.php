<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use App\Services\ExternalService;
use App\Services\TransactionService;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    private $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function index()
    {
        try {
            $transactions = auth()->user()->transaction()->paginate('10');
            return response()->json([
                'data' => $transactions
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Você ainda não possui transações registradas!'], 404);
        }
    }

    public function show($transaction)
    {
        try {
            $transactions = auth()->user()->transaction()->with('payer')->findOrFail($transaction);
            return response()->json([
                'data' => $transactions
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Transação não encontrada!'], 404);
        }
    }

    public function store(TransactionRequest $request)
    {
        try {
            $transactionService = new TransactionService();
            $transaction = $transactionService->store($request->all());
            $externalServices = new ExternalService();
            $externalServices->validateMock($transaction);
            return $this->showOne($transaction, 201);
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 422);
        }
    }
}
