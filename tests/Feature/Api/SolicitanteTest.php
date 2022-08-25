<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Solicitante;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SolicitanteTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_solicitantes_list()
    {
        $solicitantes = Solicitante::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.solicitantes.index'));

        $response->assertOk()->assertSee($solicitantes[0]->nombre);
    }

    /**
     * @test
     */
    public function it_stores_the_solicitante()
    {
        $data = Solicitante::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.solicitantes.store'), $data);

        $this->assertDatabaseHas('solicitantes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_solicitante()
    {
        $solicitante = Solicitante::factory()->create();

        $data = [
            'nombre' => $this->faker->firstName,
            'apellidos' => $this->faker->lastname,
            'fecha_de_nacimiento' => $this->faker->date,
            'sexo' => \Arr::random(['Masculino', 'Femenino', 'Otro']),
            'curp' => $this->faker->regexify("[A-Za-z0-9]{18}"),
            'correo_electronico' => $this->faker->unique->email,
            'direccion' => $this->faker->address,
        ];

        $response = $this->putJson(
            route('api.solicitantes.update', $solicitante),
            $data
        );

        $data['id'] = $solicitante->id;

        $this->assertDatabaseHas('solicitantes', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_solicitante()
    {
        $solicitante = Solicitante::factory()->create();

        $response = $this->deleteJson(
            route('api.solicitantes.destroy', $solicitante)
        );

        $this->assertSoftDeleted($solicitante);

        $response->assertNoContent();
    }
}
