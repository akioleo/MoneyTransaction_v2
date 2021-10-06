<?php

namespace App\Http\Controllers;

use App\Api\ApiMessages;
use App\Http\Requests\TransactionRequest;
use App\Http\Requests\DepositWithdrawlRequest;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function transaction(TransactionRequest $request)
    {
        DB::beginTransaction();
        try {
            $payer = auth()->user();
            $payee = User::find($request->payee);


            if($payer->account_type == 1)
                throw new \Exception('Operacao nao permitida para lojista.', 21);
            if($payer == $payee)
                throw new \Exception('Conta de destino não pode ser a mesma que a atual', 22);
            if($payer->balance < $request->value)
                throw new \Exception('Saldo insuficiente para transferência', 23);

            $payer->balance = $payer->balance - floatval($request->value);
            $payee->balance = $payee->balance + floatval($request->value);

            $auth = curl_init('https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6');
            curl_setopt($auth, CURLOPT_RETURNTRANSFER, true);
            $return = json_decode(curl_exec($auth));
            if($return->message != "Autorizado") {
                throw new \Exception('Recusado pelo autenticador!', 31);
            }
            curl_close($auth);

            $notify = curl_init('http://o4d9z.mocklab.io/notify');
            curl_setopt($notify, CURLOPT_RETURNTRANSFER, true);
            $result = json_decode(curl_exec($notify));
            if($result->message != "Success") {
                throw new \Exception('Recusado', 32);
            }
            curl_close($notify);

            $payee->save();
            $payer->save();

            $transaction = new Transaction();
            $transaction->payer = $payer->id;
            $transaction->payer = $payee->id;
            $transaction->value = $request->value;
            $transaction->status = 11;
            $transaction->save();

            return response()->json([
                'data'=>[
                    'msg' => 'Transferência realizada com sucesso!',
                    'status' => '11'
                ]
            ],200);
        } catch(\Exception $e) {
            DB::rollBack();
            $transaction = new Transaction();
            $transaction->payer = $payer->id;
            $transaction->payee = $payee->id;
            $transaction->value = $request->value;
            $transaction->status = $e->getCode();
            $transaction->save();

            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 403);
        }
    }

    public function withdrawl(DepositWithdrawlRequest $request) {
        DB::beginTransaction();
        try {
            $user = auth()->user();
            if($user->balance < $request->value) {
                throw new \Exception('Saldo insuficiente para saque', 13);
            }
            $user->balance = $user->balance - floatval($request->value);
            $user->save();

            $transaction = new Transaction();
            $transaction->payer = $user->id;
            $transaction->value = $request->value;
            $transaction->status = 12;
            $transaction->save();

            return response()->json([
                'data'=>[
                    'msg' => 'Saque realizado com sucesso!',
                    'status' => '12'
                ]
            ],200);

        } catch(\Exception $e) {
            DB::rollBack();
//            $transaction = new Transaction();
//            $transaction->payer = $user->id;
//            $transaction->value = $request->value;
//            $transaction->status = $e->getCode();
//            $transaction->save();

            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 403);
        } finally {
            DB::commit();
        }
    }

    public function deposit(DepositWithdrawlRequest $request)
    {
       DB::beginTransaction();
        try {
            $user = auth()->user();
            $user->balance = $user->balance + floatval($request->value);
            $user->save();

//            $transaction = new Transaction();
//            $transaction->payer = $user->id;
//            $transaction->payee = null;
//            $transaction->value = $request->value;
//            $transaction->status = 13;
//            $transaction->save();

            return response()->json([
                'data'=>[
                    'msg' => 'Depósito realizado com sucesso!',
                    'status' => '13'
                ]
            ],200);

        } catch (\Exception $e) {
          DB::rollback();
//            $transaction = new Transaction();
//            $transaction->payer = $user->id;
//            $transaction->payee = null;
//            $transaction->value = $request->value;
//            $transaction->status = $e->getCode();
//            $transaction->save();

            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 403);
        } finally {
            DB::commit();
        }
    }
}
