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
        Schema::create('envios', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion_general');
            $table->dateTime('posible_fecha_entrega');
            $table->tinyInteger('estados')->default(0);
            //Default 0 = no, 1 = si
            $table->tinyInteger('esta_pagado')->default(0);
            $table->foreignId('id_persona_envia')->constrained('personas');
            $table->foreignId('id_persona_recibe')->constrained('personas');
            $table->foreignId('id_sede_recibe')->nullable()->constrained('sedes_empresas');
            $table->foreignId('id_garantia')->constrained('garantias');
            $table->foreignId('id_via')->constrained('vias');



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
        Schema::dropIfExists('envios');
    }
};
