<?php

namespace Database\Factories;

use App\Models\Equipe;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MatcheFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $equipe = Equipe::inRandomOrder()->first();

        do {
            $equipe2 = Equipe::inRandomOrder()->first();
        } while ($equipe2->id === $equipe->id);

        return [
            'domicile' => $equipe->id,
            'visiteur' => $equipe2->id,
            'but_domicile' => random_int(0, 5),
            'but_visiteur' => random_int(0, 5),
            'date' => $this->faker->date(),
        ];
    }
}
