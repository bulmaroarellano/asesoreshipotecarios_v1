<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PedidosUpdateRequest extends FormRequest
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
            'folio' => [
                'required',
                Rule::unique('pedidos', 'folio')->ignore($this->pedidos),
                'max:8',
                'string',
            ],
            'destino' => [
                'required',
                'in:casa,auto,prestamo,tarjeta de credito',
            ],
            'monto_solicitado' => ['required', 'max:255', 'string'],
            'plazo' => ['required', 'max:2'],
            'applicant_id' => ['required', 'exists:applicants,id'],
        ];
    }
}
