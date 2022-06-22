<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posibles_Caracteristicas>
 */
class Posibles_CaracteristicasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {/* nombre', 'descripcion',  'unidad_medida'] */
        return [
            'nombre' => $this->faker->word,
            'descripcion' => $this->faker->text,
            'unidad_medida' => $this->faker->word,
        ];
    }
}
