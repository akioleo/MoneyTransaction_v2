<?php

namespace App\Http\Controllers;

use App\Api\ApiMessages;
use App\Http\Requests\TransactionRequest;
use App\Http\Requests\DepositWithdrawlRequest;
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

            if($payer == $payee) {
                throw new \Exception('Conta de destino não pode ser a mesma que a atual');
            }
            if($payer->account_type == 1) {
                throw new \Exception('Operacao nao permitida para lojista.');
            }
            if($payer->balance < $request->value){
                throw new \Exception('Saldo insuficiente para transferência');
            }

            $payer->balance = $payer->balance - floatval($request->value);
            $payee->balance = $payee->balance + floatval($request->value);

            $auth = curl_init('https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6');
            curl_setopt($auth, CURLOPT_RETURNTRANSFER, true);
            $return = json_decode(curl_exec($auth));
            if($return->message != "Autorizado") {
                throw new \Exception('Recusado pelo autenticador!');
            }
            curl_close($auth);

            $notify = curl_init('http://o4d9z.mocklab.io/notify');
            curl_setopt($notify, CURLOPT_RETURNTRANSFER, true);
            $result = json_decode(curl_exec($notify));
            if($result->message != "Success") {
                throw new \Exception('Recusado');
            }
            curl_close($notify);

            $payee->save();
            $payer->save();

            return response()->json([
                'data'=>[
                    'msg' => 'Transferência realizada com sucesso!',
                    'status' => '1'
                ]
            ],200);
        } catch(\Exception $e) {
            DB::rollBack();
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        } finally {
            DB::commit();
        }
    }

    public function withdrawl(DepositWithdrawlRequest $request) {
        DB::beginTransaction();
        try {
            $user = auth()->user();
            if($user->balance < $request->value) {
                throw new \Exception('Voce nao possui este saldo!');
            }
            $user->balance = $user->balance - floatval($request->value);
            $user->save();

            return response()->json([
                'data'=>[
                    'msg' => 'Saque realizado com sucesso!'
                ]
            ],200);
            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
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

            return response()->json([
                'data'=>[
                    'msg' => 'Depósito realizado com sucesso!'
                ]
            ],200);

        } catch (\Exception $e) {
          DB::rollback();
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        } finally {
            DB::commit();
        }
    }
}
