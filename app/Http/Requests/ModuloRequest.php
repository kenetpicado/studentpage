<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ModuloRequest extends FormRequest
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
        return [] +
        ($this->isMethod('POST')
            ? $this->store()
            : $this->update());
    }

    protected function store()
    {
        return [
            'nombre' => ['required', Rule::unique('modulos')->where('curso_id', $this->curso_id)],
            'curso_id' => 'required|integer'
        ];
    }

    protected function update()
    {
        return [
            'nombre' => ['required', Rule::unique('modulos')->where('curso_id', $this->curso_id)->ignore($this->modulo_id)],
        ];
    }
}
