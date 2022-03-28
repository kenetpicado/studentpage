<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCentroRequest extends FormRequest
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
            'nombre' => 'required|max:50',
            'departamento' => 'required|max:15',
            'municipio' => 'required|max:15',
            'direccion' => 'required|max:60',
            'tel' => 'required|min:8|max:8',
        ];
    }
}
