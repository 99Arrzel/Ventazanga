<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido_p');
            $table->string('apellido_m');
            $table->string('ci');
            $table->string('telefono');
            $table->string('email');
            $table->string('direccion')->nullable();
            $table->foreignId('id_ciudad')->constrained('ciudades');
            $table->softDeletes();
            $table->timestamps();
        });
        //agrego persona
        $sql = "INSERT INTO personas (nombre, apellido_p, apellido_m, ci, telefono, email, direccion, id_ciudad)
                VALUES ('Andrés', 'Carrillo', 'Zelada', '9089124', '63613646', 'af.carrillo@live.com', 'Calle 1', 1)  ";
        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
};
