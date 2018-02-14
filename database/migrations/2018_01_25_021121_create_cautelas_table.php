<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCautelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cautelas', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('reserva')->unsigned();          
            $table->integer('militar')->unsigned();
            $table->date('data_cautela');
            $table->integer('usuario_cautela')->unsigned();
            $table->date('data_entrega')->nullable();
            $table->integer('usuario_entrega')->nullable()->unsigned();
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
        Schema::dropIfExists('cautelas');
    }
}
