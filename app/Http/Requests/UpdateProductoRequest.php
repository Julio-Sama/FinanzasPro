<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductoRequest extends FormRequest
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
            'descrip_producto' => 'required|string|max:255',
            'precio_venta_producto' => 'required|numeric|min:0',
            'stock_min_producto' => 'required|numeric|min:0',
            'interes_producto' => 'required|numeric|min:0',
            'id_categoria' => 'required|exists:categoria,id_categoria'
        ];
    }
}
