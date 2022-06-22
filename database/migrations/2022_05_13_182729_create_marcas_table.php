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
        Schema::create('marcas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->softDeletes();
            $table->timestamps();
        });
        /* Añadimos marcas default */
        DB::table('marcas')->insert([
            ['nombre' => 'Samsung'],
            ['nombre' => 'Apple'],
            ['nombre' => 'Xiaomi'],
            ['nombre' => 'Huawei'],
            ['nombre' => 'Oppo'],
            ['nombre' => 'Vivo'],
            ['nombre' => 'LG'],
            ['nombre' => 'Motorola'],
            ['nombre' => 'Asus'],
            ['nombre' => 'Nokia'],
            ['nombre' => 'Sony'],
            ['nombre' => 'Lenovo'],
            ['nombre' => 'Acer'],
            ['nombre' => 'HP'],
            ['nombre' => 'Dell'],
            ['nombre' => 'Asus'],
            ['nombre' => 'Microsoft'],
            ['nombre' => 'Google'],
            ['nombre' => 'Alcatel'],
            ['nombre' => 'Blackberry'],
            ['nombre' => 'ZTE'],
            ['nombre' => 'Intel'],
            ['nombre' => 'AMD'],
            ['nombre' => 'Toshiba'],
            ['nombre' => 'Nvidia'],
            ['nombre' => 'Razer'],
            ['nombre' => 'Asrock'],
            ['nombre' => 'MSI'],
            ['nombre' => 'PNY'],
            ['nombre' => 'Gigabyte'],
            ['nombre' => 'Cooler Master'],
            ['nombre' => 'Corsair'],
            ['nombre' => 'EVGA'],
            ['nombre' => 'G.Skill'],
            ['nombre' => 'Asus'],
            /* Eso fue de computadoras, ahora quiero de comida u otros, no sé, tipo Nestle */
            ['nombre' => 'Nestle'],
            ['nombre' => 'Kellogs'],
            ['nombre' => 'Lays'],
            ['nombre' => 'Pringles'],
            /* Ok ahora marcas de bebidas */
            ['nombre' => 'Coca-Cola'],
            ['nombre' => 'Fanta'],
            ['nombre' => 'Sprite'],
            ['nombre' => '7Up'],
            ['nombre' => 'Pepsi'],
            /* Marcas de bebidas con alcohol */
            ['nombre' => 'Bacardi'],
            /* Bebidas energeticas marcas */
            ['nombre' => 'Red Bull'],
            ['nombre' => 'Monster'],
            /* Marcas de bebidas bolivianas  github copilot no me decepciones porfa*/
            /* Nooo no es coca que no entedes? es otra cosa tipop coca quina o cascada*/
            ['nombre' => 'Cascada'],
            /* Ahora marcas de autos */
            ['nombre' => 'Chevrolet'],
            ['nombre' => 'Nissan'],
            ['nombre' => 'Ford'],
            ['nombre' => 'Honda'],
            ['nombre' => 'Toyota'],
            ['nombre' => 'Hyundai'],
            ['nombre' => 'Kia'],
            ['nombre' => 'Mazda'],
            ['nombre' => 'Mitsubishi'],
            ['nombre' => 'Suzuki'],
            ['nombre' => 'Subaru'],
            ['nombre' => 'Daihatsu'],
            /* Yo que se vendo pollos */
            ['nombre' => 'Imba'],
            ['nombre' => 'Sofia'],
            ['nombre' => 'Stege'],
            /* Camisas */
            ['nombre' => 'Manhattan'],

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marcas');
    }
};
