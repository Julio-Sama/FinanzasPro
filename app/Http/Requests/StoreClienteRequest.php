<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
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
            'dui_cliente' => 'nullable',
            'nit_cliente' => 'nullable',
            'nom_cliente' => 'required',
            'tel_cliente' => 'required',
            'dir_cliente' => 'required',
            'tipo_cliente' => 'required',
            'ingreso_cliente' => 'nullable',
            'egreso_cliente' => 'nullable',
            'lugar_trabajo_cliente' => 'nullable',
            'estado_civil_cliente' => 'nullable'
        ];
    }
}
