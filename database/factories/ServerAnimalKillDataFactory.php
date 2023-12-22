<?php

namespace Database\Factories;

use App\Models\Auth\User;
use App\Models\Server;
use App\Models\ServerPlayerData;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServerAnimalKillData>
 */
class ServerAnimalKillDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomPlayer = ServerPlayerData::inRandomOrder()
            ->select('username', 'steam_id')
            ->first();

        return [
            'server_id' => Server::factory(),
            'username' => $randomPlayer->username,
            'steam_id' => $randomPlayer->steam_id,
            'animal_type' => $this->faker->randomElement(['horse', 'boar', 'chicken', 'wolf', 'shark', 'bear', 'polar_bear']),
            'distance' => $this->faker->randomFloat(1, 1, 150),
            'weapon' => $this->faker->randomElement(['m249', 'ak', 'bow', 'pump-shotgun'])
        ];
    }
}
