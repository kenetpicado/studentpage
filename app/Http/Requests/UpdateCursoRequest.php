<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCursoRequest extends FormRequest
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
            'nombre' => ['required', 'max:45', Rule::unique('cursos')->ignore($this->curso_id)],
            'imagen' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'nombre.unique' => 'Ya existe un curso con este nombre.'
        ];
    }
}
