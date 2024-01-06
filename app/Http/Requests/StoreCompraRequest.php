<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompraRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'total_compra' => 'min:0',
            'comprobante_compra' => 'required',
            'condicion_pago_compra' => 'required|in:Contado,Crédito',
            'id_proveedor' => 'required|exists:proveedor,id_proveedor'
        ];
    }
}
