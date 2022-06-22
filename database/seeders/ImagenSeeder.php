<?php

namespace Database\Seeders;

use App\Models\Imagenes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImagenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Imagenes::factory()->count(100)->create();
    }
}
