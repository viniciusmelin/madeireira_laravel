<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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

    public function messages()
    {
        return [
            'name.required'=>'Campo Obrigatório',
            'cpfcnpj.required' => 'Campo Obrigatório',
            'cpfcnpj.unique' => 'CPF já cadastrado',
            'birth_register.required' => 'Campo Obrigatório',
            'birth_date.required' => 'Campo Obrigatório',
            'limitmin.required' => 'Campo Obrigatório',
            'limitmax.required' => 'Campo Obrigatório',
            'street.required' => 'Campo Obrigatório',
            'complement.required' => 'Campo Obrigatório',
            'neighborhood.required' => 'Campo Obrigatório',
            'zip_code.required' => 'Campo Obrigatório',
            'number.required' => 'Campo Obrigatório',
            'city.required' => 'Campo Obrigatório',

        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|max:255',
            'cpfcnpj' => 'required|unique:people',
            'birth_register' => 'required',
            'birth_date' => 'required',
            'limitmin' => 'required',
            'limitmax' => 'required',
            'street' => 'required',
            'complement' => 'required',
            'neighborhood' => 'required',
            'zip_code' => 'required',
            'number' => 'required',
            'city' => 'required',
        ];
    }
}
