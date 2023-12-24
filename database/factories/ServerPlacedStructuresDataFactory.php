<?php

namespace Database\Factories;

use App\Models\Server;
use App\Models\ServerPlayerConnectionData;
use App\Models\ServerPlayerData;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServerPlacedStructuresData>
 */
class ServerPlacedStructuresDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomPlayer = ServerPlayerConnectionData::inRandomOrder()
            ->select('username', 'steam_id')
            ->first();

        $rustBuildingTypes = [
            "Foundation", "Triangle Foundation", "Steps", "Ramp", "Floor", "Floor Triangle", "Floor Frame",
            "Floor Triangle Frame", "Wall", "Doorway", "Window", "Wall Frame", "Half Wall", "Low Wall", "Stairs L Shape",
            "U Shaped Stairs", "Stairs Spiral", "Stairs Spiral Triangle", "Roof", "Roof Triangle"
        ];

        return [
            'server_id' => Server::factory(),
            'username' => $randomPlayer->username,
            'steam_id' => $randomPlayer->steam_id,
            'type' => $this->faker->randomElement($rustBuildingTypes),
            'amount' => $this->faker->numberBetween(1, 250)
        ];
    }
}
