<?php

namespace App\Http\Requests;

use App\Services\Credenciales;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DocenteRequest extends FormRequest
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
        if ($this->isMethod('POST')) {
            if (auth()->user()->sucursal != 'all')
                $this->merge(['sucursal' => auth()->user()->sucursal]);

            $this->merge([
                'carnet' => (new Credenciales)->id($this->sucursal, 4)
            ]);
        } else if (!$this->activo) {
            $this->merge(['activo' => '0']);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ['nombre' => 'required|max:45'] +

            ($this->isMethod('POST')
                ? $this->store()
                : $this->update());
    }

    protected function store()
    {
        return [
            'carnet' => 'unique:docentes',
            'correo' => 'required|unique:docentes|email:rfc,dns',
            'sucursal' => Rule::requiredIf($this->user()->sucursal == 'all')
        ];
    }

    protected function update()
    {
        return [
            'correo' => ['required', 'email:rfc,dns', Rule::unique('docentes')->ignore($this->docente_id)],
            'activo' => 'nullable'
        ];
    }
}
