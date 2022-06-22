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
        Schema::create('ciudades', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->softDeletes();
            $table->timestamps();
        });
        //Insertando ciudades base
        $sql = "INSERT INTO ciudades (nombre) VALUES ('La Paz');

        INSERT INTO ciudades (nombre) VALUES ('Alto');

                INSERT INTO ciudades (nombre) VALUES ('Cochabamba');
                INSERT INTO ciudades (nombre) VALUES ('Santa Cruz');
                INSERT INTO ciudades (nombre) VALUES ('Oruro');
                INSERT INTO ciudades (nombre) VALUES ('Potosi');
        ";
        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ciudades');
    }
};
