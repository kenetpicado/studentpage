<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNotaRequest extends FormRequest
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
            'num' => 'required|min:1|max:20',
            'materia' => ['required', 'max:50'],
            'valor' => 'required|numeric|min:0|max:100',
        ];
    }

    public function attributes()
    {
        return [
            'valor' => 'nota',
            'num' => 'numero de materia'
        ];
    }
}
