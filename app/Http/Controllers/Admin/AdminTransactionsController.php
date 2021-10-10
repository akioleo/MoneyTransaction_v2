<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $transactions =  $this->transaction->get();
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
    public function store(Request $request)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
