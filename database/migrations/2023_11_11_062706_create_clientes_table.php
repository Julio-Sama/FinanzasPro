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
        Schema::create('cliente', function (Blueprint $table) {
            $table->id('id_cliente');
            $table->string('cod_cliente', 20)->unique();
            $table->string('nom_cliente', 100);
            $table->string('dir_cliente');
            $table->string('tel_cliente', 20);
            $table->string('tipo_cliente', 50);
            $table->string('dui_cliente', 10)->nullable();
            $table->string('nit_cliente', 17)->nullable();
            $table->double('ingreso_cliente', 8, 2)->nullable();
            $table->double('egreso_cliente', 8, 2)->nullable();
            $table->string('estado_civil_cliente', 50)->nullable();
            $table->string('lugar_trabajo_cliente', 50)->nullable();
            $table->unsignedBigInteger('id_usuario');
            $table->timestamps();
        });

        Schema::table('cliente', function (Blueprint $table) {
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
        Schema::dropIfExists('cliente');
    }
};
