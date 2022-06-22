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
        Schema::create('categorias_posiblesc', function (Blueprint $table) {
            $table->foreignId('id_categoria')->constrained('categorias');
            $table->foreignId('id_posiblesc')->constrained('posibles_caracteristicas');
            $table->unique(['id_categoria', 'id_posiblesc']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorias_tienen_posibles_caracteristicas');
    }
};
