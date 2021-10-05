<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $account = $request->user();
        if($account['balance'] < 0){
            return back()->withErrors(['balance' => 'Insufficient funds']);
        }
        $transactionAmount = $request->input('edit_balance');

        DB::transaction(function () use($account, $transactionAmount, $request){
            Transaction::create([
                'id' => $account,
                'balance' => $transactionAmount
            ]);
    });
        $account->balance = $account->balace + $transactionAmount;
        $account->save();

        return redirect()->route('index')
            ->with(['message' => 'Transaction created successfully']);
    }
}
