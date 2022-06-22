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
        Schema::create('personas_cuentas_bancarias', function (Blueprint $table) {
            $table->foreignId('id_persona')->constrained('personas');
            $table->foreignId('id_cuenta_bancaria')->constrained('cuentas_bancarias');
            $table->unique(['id_persona', 'id_cuenta_bancaria']);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas_tienen_cuentas_bancarias');
    }
};
