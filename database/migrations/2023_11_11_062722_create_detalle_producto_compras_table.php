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
        Schema::create('detalle_producto_compra', function (Blueprint $table) {
            $table->id('id_detalle_compra');
            $table->integer('cant_detalle_compra');
            $table->double('precio_detalle_compra');
            $table->unsignedBigInteger('id_producto');
            $table->unsignedBigInteger('id_compra');
            $table->timestamps();
        });

        Schema::table('detalle_producto_compra', function (Blueprint $table) {
            $table->foreign('id_producto')->references('id_producto')->on('producto')->onDelete('cascade');
            $table->foreign('id_compra')->references('id_compra')->on('compra')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_producto_compra');
    }
};
