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
        Schema::create('cuota', function (Blueprint $table) {
            $table->id('id_cuota');
            $table->double('capital_cuota', 8, 2);
            $table->double('interes_cuota', 8, 2);
            $table->double('saldo_cuota', 8, 2);
            $table->double('mora_cuota', 8, 2)->nullable();
            $table->date('fecha_cuota');
            $table->string('estado_cuota', 50);
            $table->unsignedBigInteger('id_credito');
            $table->timestamps();
        });

        Schema::table('cuota', function (Blueprint $table) {
            $table->foreign('id_credito')->references('id_credito')->on('credito')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuota');
    }
};
