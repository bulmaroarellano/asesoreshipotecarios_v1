<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ApplicantUpdateRequest extends FormRequest
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
            'nombre' => ['required', 'max:255'],
            'apellidos' => ['required', 'max:255'],
            'fecha_de_nacimiento' => ['required', 'date'],
            'sexo' => ['required', 'in:masculino,femenino,otro'],
            'curp' => [
                'required',
                Rule::unique('applicants', 'curp')->ignore($this->applicant),
                'max:18',
            ],
            'correo_electronico' => [
                'required',
                Rule::unique('applicants', 'correo_electronico')->ignore(
                    $this->applicant
                ),
                'max:255',
                'string',
                'em',
            ],
            'direccion' => ['required', 'max:255'],
        ];
    }
}
