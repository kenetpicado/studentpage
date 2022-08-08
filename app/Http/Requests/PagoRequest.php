<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PagoRequest extends FormRequest
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
            'created_at' => now(),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'concepto' => 'required|max:50',
            'monto' => 'required|numeric|gt:0',
            'saldo' => 'nullable|numeric',
            'moneda' => 'required|in:CORDOBAS,DOLARES',
            'grupo_id' => 'nullable|integer',
        ] +
            ($this->isMethod('POST')
                ? $this->store()
                : $this->update());
    }

    protected function store()
    {
        return ['matricula_id' => 'required|integer'];
    }

    protected function update()
    {
        return [];
    }
}
