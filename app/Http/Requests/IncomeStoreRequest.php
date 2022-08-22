<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IncomeStoreRequest extends FormRequest
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
            'empresa' => ['nullable', 'max:255', 'string'],
            'comprobante_ingresos' => [
                'nullable',
                'in:recibos de nómina,recibo de pago por honorarios,recibo de pago por arrendamiento,movimiento de cuenta de ahorro,otro',
            ],
            'salario_bruto' => ['nullable', 'max:9'],
            'salario_neto' => ['nullable', 'max:9'],
            'tipo_empleo' => ['nullable', 'in:formal,informal,otro'],
            'fecha_contratacion' => ['nullable', 'date'],
            'applicant_id' => ['required', 'exists:applicants,id'],
        ];
    }
}
