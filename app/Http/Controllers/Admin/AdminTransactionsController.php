<?php

namespace App\Http\Controllers\Admin;

use App\Api\ApiMessages;
use App\Constants\Constants;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use Illuminate\Http\Request;

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
            return response()->json(['error' => 'Ainda não há transações registradas'], 404);
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
            return response()->json(['error' => 'Transação não encontrada'], 404);
        }
    }

    public function store(TransactionRequest $request)
    {
        $data = $request->all();

        try {
            $transactions = $this->transaction->create($data);
            if ($request->operation_type == Constants::TRANSACTION_OPERATION_WITHDRAWL || $request->operation_type == Constants::TRANSACTION_OPERATION_TRANSFER) {
                throw new \Exception('Por favor, informe o campo \'payer_id\' para prosseguir com a criação da transação');
            }
            return response()->json([
                'data' => [
                    'msg' => 'Transação cadastrada com sucesso!'
                ]
            ], 200);
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), (($e->getCode() ? $e->getCode() : 400)));
        }
    }

    public function update(TransactionRequest $request, $transaction)
    {
        $data = $request->all();

        try {
            $transactions = $this->transaction->whereId($transaction)->findOrFail($transaction);

            if ($request->operation_type == Constants::TRANSACTION_OPERATION_WITHDRAWL || $request->operation_type == Constants::TRANSACTION_OPERATION_TRANSFER) {
                throw new \Exception('Por favor, informe o campo \'payer_id\' para prosseguir com a criação da transação', 422);
            }
            $transactions->update($data);


            return response()->json([
                'data' => [
                    'msg' => 'Transação alterada com sucesso!'
                ]
            ], 200);
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), (($e->getCode() ? $e->getCode() : 404)));
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
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 404);
        }
    }
}
