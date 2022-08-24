<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Pedidos;

use App\Models\Solicitante;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PedidosControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_all_pedidos()
    {
        $allPedidos = Pedidos::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-pedidos.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_pedidos.index')
            ->assertViewHas('allPedidos');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_pedidos()
    {
        $response = $this->get(route('all-pedidos.create'));

        $response->assertOk()->assertViewIs('app.all_pedidos.create');
    }

    /**
     * @test
     */
    public function it_stores_the_pedidos()
    {
        $data = Pedidos::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-pedidos.store'), $data);

        $this->assertDatabaseHas('pedidos', $data);

        $pedidos = Pedidos::latest('id')->first();

        $response->assertRedirect(route('all-pedidos.edit', $pedidos));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_pedidos()
    {
        $pedidos = Pedidos::factory()->create();

        $response = $this->get(route('all-pedidos.show', $pedidos));

        $response
            ->assertOk()
            ->assertViewIs('app.all_pedidos.show')
            ->assertViewHas('pedidos');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_pedidos()
    {
        $pedidos = Pedidos::factory()->create();

        $response = $this->get(route('all-pedidos.edit', $pedidos));

        $response
            ->assertOk()
            ->assertViewIs('app.all_pedidos.edit')
            ->assertViewHas('pedidos');
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

        $response = $this->put(route('all-pedidos.update', $pedidos), $data);

        $data['id'] = $pedidos->id;

        $this->assertDatabaseHas('pedidos', $data);

        $response->assertRedirect(route('all-pedidos.edit', $pedidos));
    }

    /**
     * @test
     */
    public function it_deletes_the_pedidos()
    {
        $pedidos = Pedidos::factory()->create();

        $response = $this->delete(route('all-pedidos.destroy', $pedidos));

        $response->assertRedirect(route('all-pedidos.index'));

        $this->assertSoftDeleted($pedidos);
    }
}
