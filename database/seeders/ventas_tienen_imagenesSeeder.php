<?php

namespace Database\Seeders;

use App\Models\Ventas_tienen_imagenes;

use Illuminate\Database\Seeder;

class ventas_tienen_imagenesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ventas_tienen_imagenes::factory()->count(100)->create();
    }
}
