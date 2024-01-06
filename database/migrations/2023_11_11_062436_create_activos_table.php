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
        Schema::create('activo', function (Blueprint $table) {
            $table->id('id_activo');
            $table->string('cod_activo', 50);
            $table->string('descrip_activo', 50);
            $table->string('marca_activo', 50)->nullable();
            $table->string('modelo_activo', 50)->nullable();
            $table->string('serie_activo', 50)->nullable();
            $table->string('color_activo', 50)->nullable();
            $table->date('fech_compra_activo');
            $table->integer('vida_util_activo');
            $table->double('costo_compra_activo', 8, 2);
            $table->string('estado_activo', 50);
            $table->unsignedBigInteger('id_tipo');
            $table->timestamps();
        });

        Schema::table('activo', function (Blueprint $table) {
            $table->foreign('id_tipo')->references('id_tipo')->on('tipo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activo');
    }
};
