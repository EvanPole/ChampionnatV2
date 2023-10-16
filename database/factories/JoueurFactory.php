<?php

namespace Database\Factories;

use App\Models\Equipe;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class JoueurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $equipe = Equipe::inRandomOrder()->first();

        return [
            'nom' => $this->faker->name(),
            'prenom' => $this->faker->name(),
            'email' => $this->faker->email(),
            'tel' => $this->faker->phoneNumber(),
            'sexe' => $this->faker->boolean(),
            'equipe_id' => $equipe->id,
        ];
    }
}
