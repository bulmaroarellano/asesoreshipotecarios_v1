<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('empresa')->nullable();
            $table
                ->enum('comprobante_ingresos', [
                    'Recibos de nómina',
                    'Recibo de pago por honorarios',
                    'Recibo de pago por arrendamiento',
                    'Movimiento de cuenta de ahorro',
                    'Otro',
                ])
                ->nullable();
            $table->unsignedDecimal('salario_bruto', 9, 2)->nullable();
            $table->unsignedDecimal('salario_neto', 9, 2)->nullable();
            $table
                ->enum('tipo_empleo', ['formal', 'informal', 'otro'])
                ->nullable();
            $table->date('fecha_contratacion')->nullable();
            $table->unsignedBigInteger('applicant_id');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incomes');
    }
};
