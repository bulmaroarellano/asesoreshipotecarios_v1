<?php

namespace Database\Factories;

use App\Models\Ingreso;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class IngresoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ingreso::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'empresa' => $this->faker->company,
            'comprobante_ingresos' => \Arr::random([
                'Recibos de nómina',
                'Recibo de pago por honorarios',
                'Recibo de pago por arrendamiento',
                'Movimiento de cuenta de ahorro',
                'Otro',
            ]),
            'salario_bruto' => $this->faker->numerify('######'),
            'salario_neto' => $this->faker->numerify('######'),
            'tipo_empleo' => \Arr::random(['formal', 'informal', 'otro']),
            'fecha_contratacion' => $this->faker->date,
            'applicant_id' => \App\Models\Solicitante::factory(),
        ];
    }
}
