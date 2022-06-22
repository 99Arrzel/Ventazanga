<?php

namespace Database\Seeders;

use App\Models\Caracteristicas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CaracteristicasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Caracteristicas::factory()->count(100)->create();
    }
}
