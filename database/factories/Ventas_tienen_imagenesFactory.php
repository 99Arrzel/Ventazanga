<?php

namespace Database\Factories;

use App\Models\Ventas;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class Ventas_tienen_imagenesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        /* Many to many, fill with */
        $ventas = Ventas::pluck('id')->toArray();
        return [
            'id_venta' => $this->faker->unique()->randomElement($ventas),
            'id_imagen' => $this->faker->unique()->numberBetween(1, 100),
        ];
    }
}
