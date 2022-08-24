<?php

namespace Database\Seeders;

use App\Models\Solicitante;
use Illuminate\Database\Seeder;

class SolicitanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Solicitante::factory()
            ->count(5)
            ->create();
    }
}
