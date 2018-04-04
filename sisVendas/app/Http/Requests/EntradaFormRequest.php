<?php

namespace sisVendas\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntradaFormRequest extends FormRequest
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
            'idprovedor'=>'required',
            'tipo_comprovante'=>'required|max:20',
            'serie_comprovante'=>'max:7',
            'num_comprovante'=>'required|max:10',
            'idarticulo'=>'required',
            'quantidade'=>'required',
            'preco_compra'=>'required',
            'preco_venta'=>'required'
        ];
    }
}
