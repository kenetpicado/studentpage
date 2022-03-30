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
            'prematricula_id' => 'unique:matriculas',
            'grupo_id' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'prematricula_id.unique' => 'Esta persona ya se encuentra matriculada',
            'grupo_id.required' => 'Por favor, seleccione un curso.'
        ];
    }
}
