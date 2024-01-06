<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVentaRequest extends FormRequest
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
            'total_venta' => 'min:0',
            'comprobante_venta' => 'required',
            'condicion_pago_venta' => 'required|in:Contado,Crédito',
            'id_cliente' => 'required|exists:cliente,id_cliente'
        ];
    }
}
