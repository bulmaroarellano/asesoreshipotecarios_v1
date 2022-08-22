<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
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
                Rule::unique('orders', 'folio')->ignore($this->order),
                'max:13',
                'string',
            ],
            'destino' => [
                'required',
                'in:casa,auto,prestamo,tarjeta de credito',
            ],
            'monto_solicitado' => [
                '    $this->destino =="Casa" || $this->destino=="casa"? "required|between:0,200000":$this->destino == "Auto" || $this->destino=="auto"?"required|between:0,100000":$this->destino == "Prestamo" || $this->destino=="prestamo"?"required|between:0,50000": $this->destino=="tarjeta de credito"?"required|between:0,20000":"required"',
                'numeric',
                'required',
                'bail',
            ],
            'plazo' => ['required', 'max:2', 'between:1,10'],
        ];
    }
}
