<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SolicitanteUpdateRequest extends FormRequest
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
            'nombre' => ['required', 'max:255', 'string'],
            'apellidos' => ['required', 'max:255', 'string'],
            'fecha_de_nacimiento' => ['required', 'date'],
            'sexo' => ['required', 'in:masculino,femenino,otro'],
            'curp' => [
                'required',
                Rule::unique('solicitantes', 'curp')->ignore(
                    $this->solicitante
                ),
                'max:18',
                'string',
            ],
            'correo_electronico' => [
                'required',
                Rule::unique('solicitantes', 'correo_electronico')->ignore(
                    $this->solicitante
                ),
                'max:255',
                'string',
            ],
            'direccion' => ['required', 'max:255', 'string'],
        ];
    }
}
