<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function transaction(Request $request)
    {
        $error = ['status' => 1, 'mensagem' => 'Transferência Realizada com Sucesso!'];
        try {
            $validated = $request->validate([
                'payee' => 'required|numeric',
                'payer' => 'required|numeric',
                'value' => 'required|numeric|min:0'
            ]);
            //Primeira coisa, preciso identificar se quem tá pagando é lojista ou não.
            $payer = User::find($request->payer);
            $payee = User::find($request->payee);
            if($payer->account_type == 1) {
                throw new \Exception('Operação negada para lojista.');
            }
            //Agora eu preciso conferir se eu tenho saldo para a transferência.
            if($request->value <= 0) {
                //Cabe espaço para validação da quantia de casas decimais.
                throw new \Exception('O valor não está válido.');
            }
            if($payer->balance < $request->value) {
                throw new \Exception('Você não possui este saldo!');
            }
            //Agora eu preciso movimentar o dinheiro.
            $payer->balance = $payer->balance - floatval($request->value);
            $payee->balance = $payee->balance + floatval($request->value);
            //A consulta para serviços externos deve ser feita com cURL.
            $autenticador = curl_init('https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6');
            curl_setopt($autenticador, CURLOPT_RETURNTRANSFER, true);
            $retorno = json_decode(curl_exec($autenticador));
            if($retorno->message != "Autorizado") {
                throw new \Exception('Recusado pelo autenticador!');
            }
            curl_close($autenticador);
            //Tu vai ter que criar um segundo cURL, para emitir a notificação.
            //O status da transação tu vai alterar aqui, 0 se não ter notificação e 1 se ter notificação.
            $payee->save();
            $payer->save();
        } catch(\Exception $e) {
            $error['status'] = 0;
            $error['mensagem'] = $e->getMessage();
        } finally {
            echo json_encode($error);
        }
    }

    public function withdrawl(Request $request) {
        $error = ['status' => 1, 'mensagem' => 'Saque Realizado com Sucesso!'];
        try {
            $validated = $request->validate([
                'payer' => 'required|numeric',
                'value' => 'required|numeric|min:0'
            ]);
            $user = User::find($request->payer);
            if($request->value <= 0) {
                //Cabe espaço para validação da quantia de casas decimais.
                throw new \Exception('O valor não está válido.');
            }
            if($user->balance < $request->value) {
                throw new \Exception('Você não possui este saldo!');
            }
            $user->balance = $user->balance - floatval($request->value);
            $user->save();
        } catch(\Exception $e) {
            $error['status'] = 0;
            $error['mensagem'] = $e->getMessage();
        } finally {
            echo json_encode($error);
        }
    }

    public function deposit(Request $request)
    {
        $error = ['status' => 1, 'mensagem' => 'Deposito Realizado com Sucesso!'];
        try {
            $validated = $request->validate([
                'payer' => 'required|numeric',
                'value' => 'required|numeric|min:0'
            ]);
            $user = User::find($request->payer);
            if ($request->value <= 0 || (!number_format($request->value, 2, '.', ''))) {
                throw new \Exception('Valor nao permitido');
            }
            $user->balance = $user->balance + floatval($request->value);
            $user->save();
        } catch (\Exception $e) {
            $error['status'] = 0;
            $error['mensagem'] = $e->getMessage();
        } finally {
            echo json_encode($error);
        }
    }
}
