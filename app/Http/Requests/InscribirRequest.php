<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InscribirRequest extends FormRequest
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
            'grupo_id' => ['required', 
            Rule::unique('inscripciones')->where(function ($query) {
                return $query->where('matricula_id', $this->matricula_id);
            })],
        ];
    }

    public function messages()
    {
        return [
            'grupo_id.unique' => 'Ya pertenece a este grupo',
        ];
    }

    public function attributes()
    {
        return [
            'grupo_id' => 'grupo',
        ];
    }
}
