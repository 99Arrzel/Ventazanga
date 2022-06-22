<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Caracteristicas>
 */
class CaracteristicasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    /* ['id_posible_caracteristica', 'id_venta', 'cantidad'] */
    public function definition()
    {
        return [
            'id_posible_caracteristica' => $this->faker->numberBetween(1, 100),
            'id_venta' => $this->faker->numberBetween(1, 100),
            'cantidad' => $this->faker->numberBetween(1, 100),
        ];
    }
}
