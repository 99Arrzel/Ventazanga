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
        Schema::create('detalles_estados_envios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_envio')->constrained('envios');
            $table->foreignId('id_estado_envio')->constrained('estados_envios');
            $table->dateTime('fecha');
            $table->softDeletes();
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
        Schema::dropIfExists('detalles_estados_envios');
    }
};
