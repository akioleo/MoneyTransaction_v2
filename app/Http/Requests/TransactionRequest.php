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
            'payee' => 'required|numeric',
            'value' => 'required|numeric|min:0.1|min:0.1|regex:/^\d+(\.\d{1,2})?$/'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Este campo é obrigatório!',
            'min' => 'O valor mínimo deve ser R$0.1',
            'regex' => 'Deve informar no máximo duas casas decimais',
        ];
    }
}
