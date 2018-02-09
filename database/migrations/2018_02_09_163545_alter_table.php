<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('perfil')->references('id')->on('perfis');
        });

        Schema::table('materiais', function (Blueprint $table) {
            $table->foreign('reserva')->references('id')->on('reservas');
        });

        Schema::table('militares', function (Blueprint $table) {
            $table->foreign('pelotao')->references('id')->on('pelotoes');
        });

        Schema::table('cautelas', function (Blueprint $table) {
            $table->foreign('militar')->references('id')->on('militares');
            $table->foreign('usuario_cautela')->references('id')->on('users');
            $table->foreign('usuario_entrega')->references('id')->on('users');
        });

        Schema::table('cautelamateriais', function (Blueprint $table) {
            $table->foreign('cautela')->references('id')->on('cautelas');
            $table->foreign('material')->references('id')->on('materiais');
            $table->foreign('usuario_cautela')->references('id')->on('users');
            $table->foreign('usuario_entrega')->references('id')->on('users');
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
