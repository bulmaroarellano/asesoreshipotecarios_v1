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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('folio', 8)->unique();
            $table->unsignedBigInteger('applicant_id');
            $table->enum('destino', [
                'Casa',
                'Auto',
                'Prestamo',
                'Tarjeta de credito',
            ]);
            $table->string('monto_solicitado');
            $table->char('plazo', 2);

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
        Schema::dropIfExists('pedidos');
    }
};
