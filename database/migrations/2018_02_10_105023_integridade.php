<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Integridade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('perfil')->references('id')->on('reservas')->onDelete('cascade');
        });

        Schema::table('materiais', function (Blueprint $table) {
            $table->foreign('reserva')->references('id')->on('reservas')->onDelete('cascade');
        });

        Schema::table('militares', function (Blueprint $table) {
            $table->foreign('patente')->references('id')->on('postograd')->onDelete('cascade');
            $table->foreign('pelotao')->references('id')->on('pelotoes')->onDelete('cascade');
        });

        Schema::table('cautelas', function (Blueprint $table) {
            $table->foreign('reserva')->references('id')->on('reservas')->onDelete('cascade');
            $table->foreign('militar')->references('id')->on('militares')->onDelete('cascade');
            $table->foreign('usuario_cautela')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('usuario_entrega')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('cautelamateriais', function (Blueprint $table) {
            $table->foreign('cautela')->references('id')->on('cautelas')->onDelete('cascade');
            $table->foreign('material')->references('id')->on('materiais')->onDelete('cascade');
            $table->foreign('usuario_cautela')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('usuario_entrega')->references('id')->on('users')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
