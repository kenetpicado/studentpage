<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NotaRequest extends FormRequest
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
            'materia' => 'required|max:50',
            'valor' => 'required|numeric|min:0|max:100',
        ]
            + ($this->isMethod('POST')
                ? $this->store()
                : $this->update());
    }

    protected function store()
    {
        return [
            'num' => [
                'required', 'numeric', 'min:1', 'max:20',
                Rule::unique('notas')->where('inscripcion_id', $this->inscripcion_id)
            ]
        ];
    }

    protected function update()
    {
        return [
            'num' => [
                'required', 'numeric', 'min:1', 'max:20',
                Rule::unique('notas')->where('inscripcion_id', $this->inscripcion_id)->ignore($this->nota_id)
            ]
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
