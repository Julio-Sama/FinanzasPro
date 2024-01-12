<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreActivoRequest extends FormRequest
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
            'descrip_activo' => 'required',
            'marca_activo' => 'required',
            'modelo_activo' => 'required',
            'serie_activo' => 'required',
            'color_activo' => 'required',
            'fech_compra_activo' => 'required',
            'vida_util_activo' => 'required',
            'costo_compra_activo' => 'required',
            'id_tipo' => 'required'
        ];
    }
}
