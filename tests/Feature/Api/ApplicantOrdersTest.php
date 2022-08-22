<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Order;
use App\Models\Applicant;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApplicantOrdersTest extends TestCase
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
    public function it_gets_applicant_orders()
    {
        $applicant = Applicant::factory()->create();
        $orders = Order::factory()
            ->count(2)
            ->create([
                'applicant_id' => $applicant->id,
            ]);

        $response = $this->getJson(
            route('api.applicants.orders.index', $applicant)
        );

        $response->assertOk()->assertSee($orders[0]->folio);
    }

    /**
     * @test
     */
    public function it_stores_the_applicant_orders()
    {
        $applicant = Applicant::factory()->create();
        $data = Order::factory()
            ->make([
                'applicant_id' => $applicant->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.applicants.orders.store', $applicant),
            $data
        );

        unset($data['applicant_id']);

        $this->assertDatabaseHas('orders', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $order = Order::latest('id')->first();

        $this->assertEquals($applicant->id, $order->applicant_id);
    }
}
