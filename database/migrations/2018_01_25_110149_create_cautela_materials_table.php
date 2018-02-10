<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCautelaMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cautelamateriais', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cautela')->unsigned();
            $table->integer('material')->unsigned();
            $table->integer('quantidade');
            $table->date('data_cautela');
            $table->string('observacao_cautela')->nullable();
            $table->integer('usuario_cautela')->unsigned();
            $table->date('data_entrega')->nullable();
            $table->integer('usuario_entrega')->nullable()->unsigned();
            $table->string('observacao_entrega')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cautelamateriais');
    }
}
