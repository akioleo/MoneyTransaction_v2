<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'document' => ['required', 'string', 'max:14', 'unique:users'],
            'password' => ['string', 'min:8'],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Este campo é obrigatório!',
            'min' => 'Informe ao menos 8 caracteres',
            'unique' => 'O :attribute já existe',
        ];
    }

}
