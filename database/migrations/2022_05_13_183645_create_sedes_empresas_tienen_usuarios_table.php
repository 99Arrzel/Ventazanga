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
        Schema::create('sedes_empresas_tienen_usuarios', function (Blueprint $table) {
            $table->foreignId('id_sede')->constrained('sedes_empresas');
            $table->foreignId('id_usuario')->constrained('usuarios');
            $table->unique(['id_sede', 'id_usuario']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sedes_empresas_tienen_usuarios');
    }
};
