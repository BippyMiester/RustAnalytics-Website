<?php

namespace Database\Factories;

use App\Models\Server;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServerData>
 */
class ServerDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $maxPlayers = $this->faker->numberBetween(0,400);
        $minMemory = 4;
        $maxMemory = $this->faker->randomFloat(2, $minMemory, 128);

        return [
            'server_id' => Server::factory(),
            'entities' => $this->faker->numberBetween(30000, 1000000),
            'players_online' => $this->faker->numberBetween(0,$maxPlayers),
            'players_max' => $maxPlayers,
            'in_game_time' => $this->faker->time(),
            'server_fps' => $this->faker->numberBetween(24,400),
            'used_memory' => $this->faker->randomFloat(2, $minMemory, $maxMemory),
            'max_memory' => $maxMemory,
            'network_in' => $this->faker->randomFloat(2,1, 50),
            'network_out' => $this->faker->randomFloat(2,1, 50),
        ];
    }
}
