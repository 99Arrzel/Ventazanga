<?php

namespace Database\Factories;

use App\Models\Personas;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuarios>
 */
class UsuariosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        /* 'usuario', 'id_rol', 'id_persona', 'password', 'verificado', 'id_foto_verificacion', 'id_foto_perfil', 'remember_token' */
        return [
            'usuario' => $this->faker->userName,
            'id_rol' => $this->faker->numberBetween(1, 2),
            'id_persona' => $this->faker->unique()->numberBetween(10, Personas::count()),
            'password' => '$2y$10$g3ywmkcO07OqGueVZ/LpsecRhoc0frN.FFSbDacH6wRX.AXQgoLei', // password is 123
            'verificado' => $this->faker->numberBetween(0, 1),
            'id_foto_verificacion' => null,
            'id_foto_perfil' => null,
            'remember_token' => null,
        ];
    }
}
