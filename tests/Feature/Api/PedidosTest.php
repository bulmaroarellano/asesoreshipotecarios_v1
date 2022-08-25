<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Pedidos;

use App\Models\Solicitante;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PedidosTest extends TestCase
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
    public function it_gets_all_pedidos_list()
    {
        $allPedidos = Pedidos::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.all-pedidos.index'));

        $response->assertOk()->assertSee($allPedidos[0]->folio);
    }

    /**
     * @test
     */
    public function it_stores_the_pedidos()
    {
        $data = Pedidos::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.all-pedidos.store'), $data);

        $this->assertDatabaseHas('pedidos', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_pedidos()
    {
        $pedidos = Pedidos::factory()->create();

        $solicitante = Solicitante::factory()->create();

        $data = [
            'folio' => $this->faker->unique()->bothify('????-###'),
            'destino' => \Arr::random([
                'Casa',
                'Auto',
                'Prestamo',
                'Tarjeta de credito',
            ]),
            'monto_solicitado' => $this->faker->numberBetween(10000, 1000000),
            'plazo' => $this->faker->numberBetween(1, 10),
            'applicant_id' => $solicitante->id,
        ];

        $response = $this->putJson(
            route('api.all-pedidos.update', $pedidos),
            $data
        );

        $data['id'] = $pedidos->id;

        $this->assertDatabaseHas('pedidos', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_pedidos()
    {
        $pedidos = Pedidos::factory()->create();

        $response = $this->deleteJson(
            route('api.all-pedidos.destroy', $pedidos)
        );

        $this->assertSoftDeleted($pedidos);

        $response->assertNoContent();
    }
}
