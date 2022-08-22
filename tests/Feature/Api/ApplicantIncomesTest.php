<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Income;
use App\Models\Applicant;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApplicantIncomesTest extends TestCase
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
    public function it_gets_applicant_incomes()
    {
        $applicant = Applicant::factory()->create();
        $incomes = Income::factory()
            ->count(2)
            ->create([
                'applicant_id' => $applicant->id,
            ]);

        $response = $this->getJson(
            route('api.applicants.incomes.index', $applicant)
        );

        $response->assertOk()->assertSee($incomes[0]->empresa);
    }

    /**
     * @test
     */
    public function it_stores_the_applicant_incomes()
    {
        $applicant = Applicant::factory()->create();
        $data = Income::factory()
            ->make([
                'applicant_id' => $applicant->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.applicants.incomes.store', $applicant),
            $data
        );

        $this->assertDatabaseHas('incomes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $income = Income::latest('id')->first();

        $this->assertEquals($applicant->id, $income->applicant_id);
    }
}
