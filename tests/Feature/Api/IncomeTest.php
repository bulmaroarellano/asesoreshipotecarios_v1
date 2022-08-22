<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Income;

use App\Models\Applicant;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IncomeTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_incomes_list()
    {
        $incomes = Income::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.incomes.index'));

        $response->assertOk()->assertSee($incomes[0]->empresa);
    }

    /**
     * @test
     */
    public function it_stores_the_income()
    {
        $data = Income::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.incomes.store'), $data);

        $this->assertDatabaseHas('incomes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_income()
    {
        $income = Income::factory()->create();

        $applicant = Applicant::factory()->create();

        $data = [
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
            'applicant_id' => $applicant->id,
        ];

        $response = $this->putJson(route('api.incomes.update', $income), $data);

        $data['id'] = $income->id;

        $this->assertDatabaseHas('incomes', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_income()
    {
        $income = Income::factory()->create();

        $response = $this->deleteJson(route('api.incomes.destroy', $income));

        $this->assertSoftDeleted($income);

        $response->assertNoContent();
    }
}
