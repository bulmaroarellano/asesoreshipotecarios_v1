<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Applicant;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApplicantControllerTest extends TestCase
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
    public function it_displays_index_view_with_applicants()
    {
        $applicants = Applicant::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('applicants.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.applicants.index')
            ->assertViewHas('applicants');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_applicant()
    {
        $response = $this->get(route('applicants.create'));

        $response->assertOk()->assertViewIs('app.applicants.create');
    }

    /**
     * @test
     */
    public function it_stores_the_applicant()
    {
        $data = Applicant::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('applicants.store'), $data);

        $this->assertDatabaseHas('applicants', $data);

        $applicant = Applicant::latest('id')->first();

        $response->assertRedirect(route('applicants.edit', $applicant));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_applicant()
    {
        $applicant = Applicant::factory()->create();

        $response = $this->get(route('applicants.show', $applicant));

        $response
            ->assertOk()
            ->assertViewIs('app.applicants.show')
            ->assertViewHas('applicant');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_applicant()
    {
        $applicant = Applicant::factory()->create();

        $response = $this->get(route('applicants.edit', $applicant));

        $response
            ->assertOk()
            ->assertViewIs('app.applicants.edit')
            ->assertViewHas('applicant');
    }

    /**
     * @test
     */
    public function it_updates_the_applicant()
    {
        $applicant = Applicant::factory()->create();

        $data = [
            'nombre' => $this->faker->firstName,
            'apellidos' => $this->faker->lastname,
            'fecha_de_nacimiento' => $this->faker->date,
            'sexo' => \Arr::random(['Masculino', 'Femenino', 'Otro']),
            'curp' => $this->faker->unique->regexify(
                '/^[A-Z][A,E,I,O,U,X][A-Z]{2}[0-9]{2}[0-1][0-9][0-3][0-9][M,H][A-Z]{2}[B,C,D,F,G,H,J,K,L,M,N,Ñ,P,Q,R,S,T,V,W,X,Y,Z]{3}[0-9,A-Z][0-9]$/'
            ),
            'correo_electronico' => $this->faker->unique->email,
            'direccion' => $this->faker->text,
        ];

        $response = $this->put(route('applicants.update', $applicant), $data);

        $data['id'] = $applicant->id;

        $this->assertDatabaseHas('applicants', $data);

        $response->assertRedirect(route('applicants.edit', $applicant));
    }

    /**
     * @test
     */
    public function it_deletes_the_applicant()
    {
        $applicant = Applicant::factory()->create();

        $response = $this->delete(route('applicants.destroy', $applicant));

        $response->assertRedirect(route('applicants.index'));

        $this->assertSoftDeleted($applicant);
    }
}
