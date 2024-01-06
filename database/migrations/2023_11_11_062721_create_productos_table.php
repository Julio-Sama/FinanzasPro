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
        Schema::create('producto', function (Blueprint $table) {
            $table->id('id_producto');
            $table->string('descrip_producto');
            $table->double('precio_compra_producto', 8, 2);
            $table->double('precio_venta_producto', 8, 2)->check('precio_venta_producto >= precio_compra_producto');
            $table->integer('stock_producto')->check('stock_producto >= 0');
            $table->integer('stock_min_producto');
            $table->double('interes_producto', 8, 4);
            $table->unsignedBigInteger('id_categoria');
            $table->timestamps();
        });

        Schema::table('producto', function (Blueprint $table) {
            $table->foreign('id_categoria')->references('id_categoria')->on('categoria')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto');
    }
};
