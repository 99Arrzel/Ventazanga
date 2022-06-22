<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Personas>
 */
class PersonasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {/* 'nombre',
        'apellido_p',
        'apellido_m',
        'ci',
        'telefono',
        'email',
        'direccion',
        'id_ciudad', */
        return [
            'nombre' => $this->faker->firstName,
            'apellido_p' => $this->faker->lastName,
            'apellido_m' => $this->faker->lastName,
            'ci' => $this->faker->unique()->numberBetween(1000000, 9999999),
            'telefono' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'direccion' => $this->faker->address,
            'id_ciudad' => $this->faker->numberBetween(1, 6),
        ];
    }
}
