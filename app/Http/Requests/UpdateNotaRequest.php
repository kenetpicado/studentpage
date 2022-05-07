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
            'unidad' => ['required', 'max:50', 'regex:/^[1-9][1-9]?-[a-zA-Z\s]+$/'],
            'valor' => 'required|numeric|min:0|max:100',
        ];
    }
}
