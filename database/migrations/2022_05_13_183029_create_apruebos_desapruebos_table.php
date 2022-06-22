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
        Schema::create('apruebos_desapruebos', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('apruebo');
            $table->foreignId('id_usuario')->constrained('usuarios');
            $table->foreignId('id_resena')->constrained('resenas');
            $table->unique(['id_usuario', 'id_resena']);
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
        Schema::dropIfExists('apruebos_desapruebos');
    }
};
