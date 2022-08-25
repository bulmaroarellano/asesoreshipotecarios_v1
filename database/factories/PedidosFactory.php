<?php

namespace Database\Factories;

use App\Models\Pedidos;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PedidosFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pedidos::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'folio' => $this->faker->unique()->bothify('????-###'),
            'destino' => \Arr::random([
                'Casa',
                'Auto',
                'Prestamo',
                'Tarjeta de credito',
            ]),
            'monto_solicitado' => $this->faker->numberBetween(10000, 1000000),
            'plazo' => $this->faker->numberBetween(1, 10),
            'applicant_id' => \App\Models\Solicitante::factory(),
        ];
    }
}
