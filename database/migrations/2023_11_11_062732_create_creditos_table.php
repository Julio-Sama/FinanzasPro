<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credito', function (Blueprint $table) {
            $table->id('id_credito');
            $table->integer('monto_credito');
            $table->date('fech_vencimiento_credito');
            $table->string('frecuencia_pago_credito', 50);
            $table->string('nota_credito', 50)->nullable();
            $table->integer('tiemp_incobrable_credito');
            $table->string('estado_credito', 50);

            $table->unsignedBigInteger('id_venta');

            $table->timestamps();
        });

        Schema::table('credito', function (Blueprint $table) {
            $table->foreign('id_venta')->references('id_venta')->on('venta')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credito');
    }
};
