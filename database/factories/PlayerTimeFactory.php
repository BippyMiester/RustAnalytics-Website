<?php

namespace Database\Factories;

use App\Models\PlayerConnections;
use App\Models\PlayerData;
use App\Models\Server;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PlayerTime>
 */
class PlayerTimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $randomPlayer = PlayerConnections::inRandomOrder()
            ->select('steam_id')
            ->first();

        return [
            'server_id' => Server::factory(),
            'steam_id' => $randomPlayer->steam_id,
            'time' => $this->faker->numberBetween(1,5000)
        ];
    }
}
