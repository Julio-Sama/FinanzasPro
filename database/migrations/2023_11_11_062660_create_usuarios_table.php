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
        Schema::create('usuario', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('nom_usuario', 50);
            $table->string('nick_usuario', 50);
            $table->string('pass_usuario', 50);
            $table->unsignedBigInteger('id_rol');
            $table->timestamps();
        });

        Schema::table('usuario', function (Blueprint $table) {
            $table->foreign('id_rol')->references('id_rol')->on('rol')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario');
    }
};
