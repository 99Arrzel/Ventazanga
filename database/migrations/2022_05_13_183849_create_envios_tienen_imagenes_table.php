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
        Schema::create('envios_tienen_imagenes', function (Blueprint $table) {
            $table->foreignId('id_envio')->constrained('envios');
            $table->foreignId('id_imagen')->constrained('imagenes');
            $table->unique(['id_envio', 'id_imagen']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('envios_tienen_imagenes');
    }
};
