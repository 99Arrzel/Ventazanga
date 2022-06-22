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
        Schema::create('usuarios_tienen_imagenes', function (Blueprint $table) {
            $table->foreignId('id_usuario')->constrained('usuarios');
            $table->foreignId('id_imagen')->constrained('imagenes');
            $table->unique(['id_usuario', 'id_imagen']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios_tienen_imagenes');
    }
};
