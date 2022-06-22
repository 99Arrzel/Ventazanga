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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('usuario');
            $table->string('password');
            $table->foreignId('id_rol')->constrained('roles');
            $table->foreignId('id_persona')->constrained('personas');
            $table->tinyInteger('verificado')->default(0);
            $table->foreignId('id_foto_verificacion')->nullable()->constrained('imagenes');
            $table->foreignId('id_foto_perfil')->nullable()->constrained('imagenes');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
        //Inserto mi usuario admin admin
        $sql = "INSERT INTO usuarios (usuario, password, id_rol, id_persona)
                VALUES ('admin', '$2y$10\$ennBnCZIdQqmm3YGXGbDlOhP3gFXTGh3CvCAleyb7/LESgQxmp1my', 1, 1)";
        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
};
