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
        Schema::create('posibles_caracteristicas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion')->nullable();
            $table->string('unidad_medida')->nullable();
            $table->timestamps();
        });
        /* Inserto posibles caracteristicas de algo, a ver para telefonos por ejemplo la camara, pantalla, bateria */
        DB::table('posibles_caracteristicas')->insert([
            ['nombre' => 'Camara[MPx]', 'descripcion' => 'La camara es una pieza que se encuentra en distintos aparatos electrónicos', 'unidad_medida' => 'Mega pixeles'],
            ['nombre' => 'Pantalla[Px]', 'descripcion' => 'La pantalla es una pieza que se encuentra en distintos aparatos electrónicos', 'unidad_medida' => 'Pulgadas'],
            ['nombre' => 'Bateria[mAh]', 'descripcion' => 'La bateria es una pieza que se encuentra en distintos aparatos electrónicos', 'unidad_medida' => 'Amperios'],
            ['nombre' => 'Peso[Kg]', 'descripcion' => 'El peso como medida en kilogramos', 'unidad_medida' => 'Kilogramos'],
            ['nombre' => 'Alto[M]', 'descripcion' => 'El alto como medida en metros', 'unidad_medida' => 'Metros'],
            ['nombre' => 'Ancho[M]', 'descripcion' => 'El ancho como medida en metros', 'unidad_medida' => 'Metros'],
            /* Ahora dame de litros */
            ['nombre' => 'Capacidad[L]', 'descripcion' => 'La capacidad como medida en litros', 'unidad_medida' => 'Litros'],
            /* peso en gramos */
            ['nombre' => 'Peso[g]', 'descripcion' => 'El peso como medida en gramos', 'unidad_medida' => 'Gramos'],
            /* peso en miligramos */
            ['nombre' => 'Peso[mg]', 'descripcion' => 'El peso como medida en miligramos', 'unidad_medida' => 'Miligramos'],
            /* Almacenamiento en GBs */
            ['nombre' => 'Almacenamiento[GB]', 'descripcion' => 'El almacenamiento como medida en gigabytes', 'unidad_medida' => 'Gigabytes'],
            /* Almacenamiento en Tbs */
            ['nombre' => 'Almacenamiento[TB]', 'descripcion' => 'El almacenamiento como medida en terabytes', 'unidad_medida' => 'Terabytes'],
            /* Almacenamiento en MBs */
            ['nombre' => 'Almacenamiento[MB]', 'descripcion' => 'El almacenamiento como medida en megabytes', 'unidad_medida' => 'Megabytes'],
            /* Frecuencia, cache, etc, cosas de procesadores*/
            ['nombre' => 'Frecuencia[GHz]', 'descripcion' => 'La frecuencia como medida en gigahercios', 'unidad_medida' => 'Gigahercios'],
            ['nombre' => 'Cache[MB]', 'descripcion' => 'El cache como medida en megabytes', 'unidad_medida' => 'Megabytes'],
            /* cilindraje de un motor, si es 4x4, si el bloqueo de diferencial se puede aplicar, etc  */
            ['nombre' => 'Cilindraje[cc]', 'descripcion' => 'El cilindraje como medida en centimetros cúbicos', 'unidad_medida' => 'Centimetros cubicos'],
            /* Por qué null? bueno, es un si o no, así que solo debería mostrar un dropdown de si o no */
            ['nombre' => 'Bloqueo[Diferencial]', 'descripcion' => 'El diferencial se puede bloquear', 'unidad_medida' => null],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posibles__caracteristicas');
    }
};
