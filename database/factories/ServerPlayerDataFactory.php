<?php

namespace Database\Factories;

use App\Models\Server;
use App\Models\ServerPlayerConnectionData;
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
        $randomPlayer = ServerPlayerConnectionData::inRandomOrder()
            ->select('steam_id')
            ->first();

        return [
            'server_id' => Server::factory(),
            'frame_rate' => $this->faker->numberBetween(16, 240),
            'packet_loss' => $this->faker->numberBetween(1, 1000),
            'steam_id' => $randomPlayer->steam_id
        ];
    }
}
