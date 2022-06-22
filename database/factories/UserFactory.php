<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{

    /* The name of the model */
    protected $model = User::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'last_name_p' => $this->faker->lastName,
            'last_name_m' => $this->faker->lastName,
            /* unique ci */

            'ci' => $this->faker->numberBetween(1000000, 9999999),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'phone' => $this->faker->numberBetween(10000000, 99999999),
            'password' => '$2y$10$g3ywmkcO07OqGueVZ/LpsecRhoc0frN.FFSbDacH6wRX.AXQgoLei', // password is 123
            'id_city' => $this->faker->numberBetween(1, 7),
            'status' => $this->faker->numberBetween(0, 1),
            'description' => $this->faker->text(),
            'id_carne_photo' => 1,
            'id_rol' => $this->faker->numberBetween(1, 3),



        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
