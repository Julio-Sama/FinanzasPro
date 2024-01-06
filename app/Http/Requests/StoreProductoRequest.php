<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest
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
            'descrip_producto' => 'required',
            'precio_venta_producto' => 'required',
            'stock_min_producto' => 'required',
            'interes_producto' => 'required',
            'id_categoria' => 'required'
        ];
    }
}
