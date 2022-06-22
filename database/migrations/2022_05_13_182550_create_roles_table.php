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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        $sql = "
            INSERT INTO roles (id, nombre, descripcion, created_at, updated_at, deleted_at) VALUES
            (1, 'Administrador', 'Administrador del sistema', '2020-05-13 18:25:50', '2020-05-13 18:25:50', NULL),
            (2, 'Usuario', 'Usuario del sistema', '2020-05-13 18:25:50', '2020-05-13 18:25:50', NULL);
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
        Schema::dropIfExists('roles');
    }
};
