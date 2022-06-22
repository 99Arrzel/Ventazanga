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
        Schema::create('ventas_tienen_imagenes', function (Blueprint $table) {
            $table->foreignId('id_venta')->constrained('ventas');
            $table->foreignId('id_imagen')->constrained('imagenes');
            $table->unique(['id_venta', 'id_imagen']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas_tienen_imagenes');
    }
};
