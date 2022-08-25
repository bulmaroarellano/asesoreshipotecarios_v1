<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Pedidos;
use App\Models\Solicitante;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SolicitanteAllPedidosTest extends TestCase
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
    public function it_gets_solicitante_all_pedidos()
    {
        $solicitante = Solicitante::factory()->create();
        $allPedidos = Pedidos::factory()
            ->count(2)
            ->create([
                'applicant_id' => $solicitante->id,
            ]);

        $response = $this->getJson(
            route('api.solicitantes.all-pedidos.index', $solicitante)
        );

        $response->assertOk()->assertSee($allPedidos[0]->folio);
    }

    /**
     * @test
     */
    public function it_stores_the_solicitante_all_pedidos()
    {
        $solicitante = Solicitante::factory()->create();
        $data = Pedidos::factory()
            ->make([
                'applicant_id' => $solicitante->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.solicitantes.all-pedidos.store', $solicitante),
            $data
        );

        $this->assertDatabaseHas('pedidos', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $pedidos = Pedidos::latest('id')->first();

        $this->assertEquals($solicitante->id, $pedidos->applicant_id);
    }
}
