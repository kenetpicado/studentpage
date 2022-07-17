<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CursoRequest extends FormRequest
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
        return ['imagen' => 'required|min:3|max:50'] +

            ($this->isMethod('POST')
                ? $this->store()
                : $this->update());
    }

    protected function store()
    {
        return ['nombre' => 'required|max:45|unique:cursos'];
    }

    protected function update()
    {
        return ['nombre' => ['required', 'max:45', Rule::unique('cursos')->ignore($this->curso_id)]];
    }

    public function messages()
    {
        return [
            'nombre.unique' => 'Ya existe un curso con este nombre.'
        ];
    }
}
