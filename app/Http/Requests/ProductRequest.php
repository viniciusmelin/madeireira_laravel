<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        return
        [
            'description.required'=>'Campo Obrigatório!',
            'amount_min.required'=>'Campo Obrigatório!',
            'amount.required'=>'Campo Obrigatório!',
            'price.required'=>'Campo Obrigatório!'
            
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
            'description'=>'required|max:80',
            'width'=>'',
            'height'=>'',
            'deep'=>'',
            'amount_min'=>'required',
            'cubing'=>'',
            'price'=>'required',
            'amount'=>'required',
        ];
    }
}
