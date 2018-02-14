<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMilitarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('militares', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->integer('patente')->unsigned();
            $table->string('nome_guerra');
            $table->string('telefone')->nullable();
            $table->string('email')->nullable();
            $table->integer('pelotao')->unsigned();
            $table->integer('active')->default(1);
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
        Schema::dropIfExists('militares');
    }
}
