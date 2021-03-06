<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'payer_id' => 'prohibited_if:operation_type,DEPOSIT|numeric',
            'payee_id' => 'required_if:operation_type,TRANSFER,DEPOSIT|prohibited_if:operation_type,WITHDRAWL|numeric|exists:users,id',
            'value' => 'required|numeric|min:0.1|min:0.1|regex:/^\d+(\.\d{1,2})?$/',
            'operation_type' => 'required|in:TRANSFER,WITHDRAWL,DEPOSIT',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Este campo é obrigatório!',
            'required_if' => 'Este campo é obrigatório para operações de :value',
            'min' => 'O valor mínimo deve ser R$0.1',
            'regex' => 'Deve informar no máximo duas casas decimais',
            'exists' => 'Usuário não existe no sistema',
            'prohibited_if' => 'O campo :attribute é proibido quando a operação é :value'
        ];
    }
}
