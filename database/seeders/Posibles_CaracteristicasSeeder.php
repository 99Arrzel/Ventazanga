<?php

namespace Database\Seeders;

use App\Models\Posibles_Caracteristicas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Posibles_CaracteristicasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Posibles_Caracteristicas::factory()->count(100)->create();
    }
}
