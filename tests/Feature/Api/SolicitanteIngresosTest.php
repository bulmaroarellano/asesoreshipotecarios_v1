<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Ingreso;
use App\Models\Solicitante;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SolicitanteIngresosTest extends TestCase
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
    public function it_gets_solicitante_ingresos()
    {
        $solicitante = Solicitante::factory()->create();
        $ingresos = Ingreso::factory()
            ->count(2)
            ->create([
                'applicant_id' => $solicitante->id,
            ]);

        $response = $this->getJson(
            route('api.solicitantes.ingresos.index', $solicitante)
        );

        $response->assertOk()->assertSee($ingresos[0]->empresa);
    }

    /**
     * @test
     */
    public function it_stores_the_solicitante_ingresos()
    {
        $solicitante = Solicitante::factory()->create();
        $data = Ingreso::factory()
            ->make([
                'applicant_id' => $solicitante->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.solicitantes.ingresos.store', $solicitante),
            $data
        );

        unset($data['applicant_id']);

        $this->assertDatabaseHas('ingresos', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $ingreso = Ingreso::latest('id')->first();

        $this->assertEquals($solicitante->id, $ingreso->applicant_id);
    }
}
