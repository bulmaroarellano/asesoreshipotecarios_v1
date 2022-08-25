<?php

namespace Database\Factories;

use App\Models\Solicitante;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SolicitanteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Solicitante::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->firstName,
            'apellidos' => $this->faker->lastname,
            'fecha_de_nacimiento' => $this->faker->date,
            'sexo' => \Arr::random(['Masculino', 'Femenino', 'Otro']),
            'curp' => $this->faker->regexify("[A-Za-z0-9]{18}"),
            'correo_electronico' => $this->faker->unique->email,
            'direccion' => $this->faker->address,
        ];
    }
}
