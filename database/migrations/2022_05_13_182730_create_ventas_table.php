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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->foreignId('id_categoria')->constrained('categorias');
            $table->foreignId('id_vendedor')->constrained('usuarios');
            //Si el producto es usado, nuevo, que onda, que es? 0 usado 1 nuevo
            $table->tinyInteger('estado_venta')->nullable()->default(1);
            $table->foreignId('id_garantia')->nullable()->constrained('garantias');
            $table->foreignId('id_ciudad')->constrained('ciudades');
            //si es algun contenido prohibido omg 0 es no 1 es si

            //Esto para saber si buscar alquilar, vender o intercambiar, respectivamente 0 , 1 , 2; además
            //si quiere todo  es 3, si solo quiere alquilar o vender es 4, y si solo quiere vender o intercambiar es 5
            $table->tinyInteger('tipo_venta')->default(1);
            $table->decimal('precio_venta', 20, 2);
            $table->foreignId('id_marca')->nullable()->constrained('marcas');
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
        Schema::dropIfExists('ventas');
    }
};
