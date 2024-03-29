<?php

namespace App\Http\Requests;

use App\Services\Credenciales;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class PromotorRequest extends FormRequest
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
        if ($this->isMethod('POST'))
            $this->merge([
                'carnet' => (new Credenciales)->id('PM', 4),
            ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ['nombre' => 'required|max:45']

            + ($this->isMethod('POST')
                ? $this->store()
                : $this->update());
    }

    protected function store()
    {
        return [
            'correo' => 'required|unique:promotors|email:rfc,dns',
            'carnet' => 'required|unique:promotors'
        ];
    }

    protected function update()
    {
        return ['correo' => ['required', 'email:rfc,dns', Rule::unique('promotors')->ignore($this->promotor_id)],];
    }
}
