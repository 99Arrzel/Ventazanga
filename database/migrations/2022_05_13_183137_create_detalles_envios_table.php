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
        Schema::create('detalles_envios', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad');
            $table->decimal('peso_unitario', 8, 2);
            $table->decimal('alto_unitario', 8, 2);
            $table->decimal('ancho_unitario', 8, 2);
            $table->decimal('profundidad_unitario', 8, 2);
            $table->decimal('costo_envio_unitario', 8, 2);
            $table->decimal('cost_unitario_declarado', 8, 2);
            //Estado del objeto, 0 es usado 1 es nuevo
            $table->tinyInteger('estado_objeto')->default(0);
            //Tiene factura o no, 0 es no tiene, 1 es tiene
            $table->tinyInteger('tiene_factura')->default(0);
            $table->foreignId('id_envio')->constrained('envios');
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
        Schema::dropIfExists('detalles_envios');
    }
};
