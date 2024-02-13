<?php

namespace Database\Factories;

use App\Models\Server;
use App\Models\PlayerConnections;
use App\Models\PlayerData;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServerPlayerGatherData>
 */
class PlayerGatherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomPlayer = PlayerConnections::inRandomOrder()
            ->select('username', 'steam_id')
            ->first();

        return [
            'server_id' => Server::factory(),
            'username' => $randomPlayer->username,
            'steam_id' => $randomPlayer->steam_id,
            'resource' => $this->faker->randomElement(['Sulfur Ore', 'Metal Ore', 'Stone', 'Cloth', 'Animal Fat']),
            'amount' => $this->faker->numberBetween(1,250),
            'created_at' => $this->faker->dateTimeThisMonth()
        ];
    }
}
