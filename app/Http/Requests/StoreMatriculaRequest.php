<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMatriculaRequest extends FormRequest
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
            'nombre' => 'required|max:45',
            'cedula' => 'nullable|alpha_dash|min:16|max:16',
            'fecha_nac' => 'required|date',
            'tel' => 'nullable|min:8|max:8',
            'grado' => 'required|max:45',
            'grupo_id' => 'required'
        ];
    }
    public function attributes()
    {
        return [
            'fecha_nac' => 'fecha de nacimiento',
            'tel' => 'telefono',
        ];
    }
    public function messages()
    {
        return [
            'grupo_id.required' => 'Por favor, seleccione un curso.'
        ];
    }
}
