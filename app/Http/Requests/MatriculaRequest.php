<?php

namespace App\Http\Requests;

use App\Services\Credenciales;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MatriculaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this this.
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
                $this->merge(['sucursal' =>  auth()->user()->sucursal]);

            if ($this->carnet == '')
                $this->merge([
                    'carnet' => (new Credenciales)->idEstudiante($this->sucursal, $this->fecha_nac)
                ]);


            $this->merge([
                'pin' => (new Credenciales)->pin(),
                'promotor_id' => auth()->user()->sub_id,
                'created_at' => now()->format('Y-m-d'),
            ]);
        }
    }


    /**
     * Get the validation rules that apply to the this.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required|max:45',
            'cedula' => 'nullable|alpha_dash|min:16|max:16',
            'fecha_nac' => 'required|date',
            'celular' => 'nullable|numeric|digits:8',
            'grado' => 'required|max:45',
            'tutor' => 'nullable'
        ]
            + ($this->isMethod('POST')
                ? $this->store()
                : $this->update());
    }

    protected function store()
    {
        return [
            'carnet' => 'nullable|unique:matriculas|alpha_dash|min:15|max:15',
            'pin' => 'required|min:6|alpha_dash',
            'sucursal' => [Rule::requiredIf($this->user()->sucursal == 'all')]
        ];
    }

    protected function update()
    {
        return [];
    }

    public function attributes()
    {
        return [
            'fecha_nac' => 'fecha de nacimiento',
            'tel' => 'telefono',
        ];
    }
}
