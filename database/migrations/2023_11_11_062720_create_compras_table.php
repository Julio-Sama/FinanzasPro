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
        Schema::create('compra', function (Blueprint $table) {
            $table->id('id_compra');
            $table->double('total_compra', 8, 2);
            $table->date('fech_compra');
            $table->string('estado_compra', 50);
            $table->string('comprobante_compra', 50);
            $table->string('condicion_pago_compra', 50);
            $table->unsignedBigInteger('id_proveedor');
            $table->unsignedBigInteger('id_usuario');
            $table->timestamps();
        });

        Schema::table('compra', function (Blueprint $table) {
            $table->foreign('id_proveedor')->references('id_proveedor')->on('proveedor')->onDelete('cascade');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compra');
    }
};
