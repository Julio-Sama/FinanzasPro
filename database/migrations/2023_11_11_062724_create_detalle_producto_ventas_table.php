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
        Schema::create('detalle_producto_venta', function (Blueprint $table) {
            $table->id('id_detalle_venta');
            $table->integer('cant_detalle_venta');
            $table->double('precio_detalle_venta');
            $table->unsignedBigInteger('id_producto');
            $table->unsignedBigInteger('id_venta');
            $table->timestamps();
        });

        Schema::table('detalle_producto_venta', function (Blueprint $table) {
            $table->foreign('id_producto')->references('id_producto')->on('producto')->onDelete('cascade');
            $table->foreign('id_venta')->references('id_venta')->on('venta')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_producto_venta');
    }
};
