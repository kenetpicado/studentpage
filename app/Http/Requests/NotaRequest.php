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

    protected function prepareForValidation()
    {
        $this->merge([
            'created_at' => now()->format('Y-m-d'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ['valor.*' => 'required|numeric|min:0|max:100']
            + ($this->isMethod('POST')
                ? $this->store()
                : $this->update());
    }

    protected function store()
    {
        return ['modulo_id' => 'required'];
        //return ['modulo_id' => 'required', Rule::unique('notas')->where($this->grupo_id)];
    }

    protected function update()
    {
        return ['nota_id.*' => 'required'];
    }

    public function attributes()
    {
        return [
            'valor.*' => 'nota',
            'modulo_id' => 'modulo'
        ];
    }
}
