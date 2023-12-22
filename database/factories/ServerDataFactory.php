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
        return [
            'server_id' => Server::factory(),
            'frame_rate' => $this->faker->numberBetween(16, 240),
            'memory' => $this->faker->numberBetween(8000, 128000),
            'player_count' => $this->faker->numberBetween(0, 120),
            'entities' => $this->faker->numberBetween(30000, 1000000),
            'average_client_latency' => $this->faker->numberBetween(1,225)
        ];
    }
}
