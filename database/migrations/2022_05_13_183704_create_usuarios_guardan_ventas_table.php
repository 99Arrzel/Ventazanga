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
        Schema::create('usuarios_guardan_ventas', function (Blueprint $table) {
            $table->foreignId('id_usuario')->constrained('usuarios');
            $table->foreignId('id_venta')->constrained('ventas');
            $table->unique(['id_usuario', 'id_venta']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios_guardan_ventas');
    }
};
