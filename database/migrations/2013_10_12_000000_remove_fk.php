<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('users', function(Blueprint $table){
            $table->dropForeign('users_perfil_foreign');
            $table->dropColumn('perfil');
        });

        Schema::dropIfExists('materiais', function (Blueprint $table) {
            $table->dropForeign('materiais_reserva_foreign');
            $table->dropColumn('reserva');
        });

        Schema::dropIfExists('militares', function (Blueprint $table) {
            $table->dropForeign('militares_patente_foreign');
            $table->dropForeign('militares_pelotao_foreign');
            $table->dropColumn('patente');
            $table->dropColumn('pelotao');
        });

        Schema::dropIfExists('cautelas', function (Blueprint $table) {
            $table->dropForeign('cautelas_reserva_foreign');
            $table->dropForeign('cautelas_militar_foreign');
            $table->dropForeign('cautelas_usuario_cautela_foreign');
            $table->dropForeign('cautelas_usuario_entrega_foreign');
            $table->dropColumn('reserva');
            $table->dropColumn('militar');
            $table->dropColumn('usuario_cautela');
            $table->dropColumn('usuario_entrega');
        });

        Schema::dropIfExists('cautelamateriais', function (Blueprint $table) {
            $table->dropForeign('cautelamateriais_cautela_foreign');
            $table->dropForeign('cautelamateriais_material_foreign');
            $table->dropForeign('cautelamateriais_usuario_cautela_foreign');
            $table->dropForeign('cautelamateriais_usuario_entrega_foreign');
            $table->dropColumn('cautela');
            $table->dropColumn('material');
            $table->dropColumn('usuario_cautela');
            $table->dropColumn('usuario_entrega');
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
