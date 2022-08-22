<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ApplicantStoreRequest extends FormRequest
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
            'curp' => ['required', 'unique:applicants,curp', 'max:18'],
            'correo_electronico' => [
                'required',
                'unique:applicants,correo_electronico',
                'max:255',
                'email',
            ],
            'direccion' => ['required', 'max:255'],
        ];
    }
}
