<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsuarioRequest extends FormRequest
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
            'nom_usuario' => 'required|max:50',
            'nick_usuario' => 'required|max:50',
            'pass_usuario' => 'required|max:255',
            'id_rol' => 'required|integer',
        ];
    }
}
