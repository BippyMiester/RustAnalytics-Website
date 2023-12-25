<?php

namespace Database\Factories;

use App\Models\Server;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServerPlayerConnectionData>
 */
class ServerPlayerConnectionDataFactory extends Factory
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
            'steam_id' => $this->faker->randomNumber(8, true) . $this->faker->randomNumber(8, true),
            'ip_address' => $this->faker->ipv4(),
            'username' => $this->faker->userName(),
            'online_seconds' => $this->faker->numberBetween(60, 64000),
            'afk_seconds' => $this->faker->numberBetween(60, 64000),
        ];
    }
}
