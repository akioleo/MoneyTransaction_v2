<?php

namespace App\Http\Controllers;

use App\Api\ApiMessages;
use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use App\Models\User;
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
    public function index(User $users)
    {
        $user = auth()->user();
        $transactions = $user->$this->transaction;
        return response()->json([
            'data' => $transactions
        ], 200);
    }

    public function show($transaction)
    {
        $transactions = $this->transaction->whereId($transaction)->first();
        return response()->json([
            'data' => $transactions
        ], 200);
    }

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
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 422);
        }
    }


}
