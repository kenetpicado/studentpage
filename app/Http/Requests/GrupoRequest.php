<?php

namespace App\Http\Requests;

use App\Models\Docente;
use Illuminate\Foundation\Http\FormRequest;

class GrupoRequest extends FormRequest
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
            'sucursal' => Docente::find($this->docente_id)->sucursal,
            'anyo' => now()->format('Y'),
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
            'docente_id' => 'required',
            'horario' => 'required|max:20'
        ] +

            ($this->isMethod('POST')
                ? $this->store()
                : $this->update());
    }

    protected function store()
    {
        return ['curso_id' => 'required'];
    }

    protected function update()
    {
        return ['curso_id' => 'exclude'];
    }

    public function attributes()
    {
        return [
            'curso_id' => 'curso',
            'docente_id' => 'docente',
        ];
    }
}
