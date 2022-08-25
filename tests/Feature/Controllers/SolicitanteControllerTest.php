<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Solicitante;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SolicitanteControllerTest extends TestCase
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
    public function it_displays_index_view_with_solicitantes()
    {
        $solicitantes = Solicitante::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('solicitantes.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.solicitantes.index')
            ->assertViewHas('solicitantes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_solicitante()
    {
        $response = $this->get(route('solicitantes.create'));

        $response->assertOk()->assertViewIs('app.solicitantes.create');
    }

    /**
     * @test
     */
    public function it_stores_the_solicitante()
    {
        $data = Solicitante::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('solicitantes.store'), $data);

        $this->assertDatabaseHas('solicitantes', $data);

        $solicitante = Solicitante::latest('id')->first();

        $response->assertRedirect(route('solicitantes.edit', $solicitante));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_solicitante()
    {
        $solicitante = Solicitante::factory()->create();

        $response = $this->get(route('solicitantes.show', $solicitante));

        $response
            ->assertOk()
            ->assertViewIs('app.solicitantes.show')
            ->assertViewHas('solicitante');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_solicitante()
    {
        $solicitante = Solicitante::factory()->create();

        $response = $this->get(route('solicitantes.edit', $solicitante));

        $response
            ->assertOk()
            ->assertViewIs('app.solicitantes.edit')
            ->assertViewHas('solicitante');
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

        $response = $this->put(
            route('solicitantes.update', $solicitante),
            $data
        );

        $data['id'] = $solicitante->id;

        $this->assertDatabaseHas('solicitantes', $data);

        $response->assertRedirect(route('solicitantes.edit', $solicitante));
    }

    /**
     * @test
     */
    public function it_deletes_the_solicitante()
    {
        $solicitante = Solicitante::factory()->create();

        $response = $this->delete(route('solicitantes.destroy', $solicitante));

        $response->assertRedirect(route('solicitantes.index'));

        $this->assertSoftDeleted($solicitante);
    }
}
