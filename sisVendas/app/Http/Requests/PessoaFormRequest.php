<?php

namespace sisVendas\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PessoaFormRequest extends FormRequest
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
            'nome'=>'required|max:100',
            'tipo_documento'=>'required|max:20',
            'num_documento'=>'required|max:15',
            'endereco'=>'max:70',
            'telefone'=>'max:15',
            'email'=>'max:50'
        ];
    }
}
