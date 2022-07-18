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
            'modulo_id' => 'required',
            'valor' => 'required|numeric|min:0|max:100',
            'inscripcion_id' => 'required'
        ];
            // + ($this->isMethod('POST')
            //     ? $this->store()
            //     : $this->update());
    }

    protected function store()
    {
        return [
            'modulo_id' => [
                'required', Rule::unique('notas')->where('inscripcion_id', $this->inscripcion_id)
            ]
        ];
    }

    protected function update()
    {
        return [
            'num' => [
                'required', Rule::unique('notas')->where('inscripcion_id', $this->inscripcion_id)->ignore($this->nota_id)
            ]
        ];
    }

    public function attributes()
    {
        return [
            'valor' => 'nota',
            'modulo_id' => 'modulo'
        ];
    }
}
