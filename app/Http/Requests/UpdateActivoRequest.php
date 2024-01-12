<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateActivoRequest extends FormRequest
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
            // cod_activo, descrip_activo, marca_activo, modelo_activo, serie_activo,
            // color_activo, fecha_compra_activo, vida_util_activo, costo_compra_activo, estado_activo, id_tipo.
            'cod_activo' => 'required|string|max:255',
            'descrip_activo' => 'required|string|max:255',
            'marca_activo' => 'required|string|max:255',
            'modelo_activo' => 'required|string|max:255',
            'serie_activo' => 'required|string|max:255',
            'color_activo' => 'required|string|max:255',
            // 'fecha_compra_activo' => 'required|date',
            'vida_util_activo' => 'required|numeric|min:0',
            'costo_compra_activo' => 'required|numeric|min:0',
            // 'estado_activo' => 'required|string|max:255',
            'id_tipo' => 'required|exists:tipos,id_tipo'

        ];
    }
}
