<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGrupoRequest extends FormRequest
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
            //
            'docente_id' => 'required',
            'horario' => 'required|max:20',
        ];
    }
    public function attributes()
    {
        return [
            'curso_id' => 'curso',
            'docente_id' => 'docente',
        ];
    }
}
