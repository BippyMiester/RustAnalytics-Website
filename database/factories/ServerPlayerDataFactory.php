<?php

namespace Database\Factories;

use App\Models\Server;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ServerPlayerDataFactory extends Factory
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
            'packet_loss' => $this->faker->numberBetween(1, 1000),
            'online_seconds' => $this->faker->numberBetween(60, 64000),
            'afk_seconds' => $this->faker->numberBetween(60, 64000),
            'steam_id' => $this->faker->randomNumber(8, true) . $this->faker->randomNumber(8, true),
            'ip_address' => $this->faker->ipv4(),
            'username' => $this->faker->userName()
        ];
    }
}
