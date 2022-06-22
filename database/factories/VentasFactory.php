<?php

namespace Database\Factories;

use App\Models\Categorias;
use App\Models\Marcas;
use App\Models\Usuarios;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ventas>
 */
class VentasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        /*  'nombre',
        'descripcion',
        'id_categoria',
        'id_vendedor',
        'estado_venta',
        'id_garantia',
        'id_ciudad',

        'tipo_venta',
        'precio_venta',

        'id_marca', */
        return [
            'nombre' => $this->faker->word,
            'descripcion' => $this->faker->text,
            'id_categoria' => $this->faker->numberBetween(40, 50),
            'id_vendedor' => $this->faker->numberBetween(1, Usuarios::count()),
            'estado_venta' => $this->faker->numberBetween(1, 2),
            'id_garantia' => null,
            'id_ciudad' => $this->faker->numberBetween(1, 6),
            'tipo_venta' => $this->faker->numberBetween(1, 2),
            'precio_venta' => $this->faker->numberBetween(1, 100),
            'id_marca' => $this->faker->numberBetween(1, Marcas::count()),
        ];
    }
}
