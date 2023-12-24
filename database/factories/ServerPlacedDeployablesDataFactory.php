<?php

namespace Database\Factories;

use App\Models\Server;
use App\Models\ServerPlayerConnectionData;
use App\Models\ServerPlayerData;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServerPlacedDeployablesData>
 */
class ServerPlacedDeployablesDataFactory extends Factory
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
            "Armored Door", "Armored Double Door", "Barbed Wooden Barricade", "Building Plan", "Chainlink Fence",
            "Chainlink Fence Gate", "Code Lock", "Concrete Barricade", "Door Closer", "Floor grill", "Floor triangle grill",
            "Garage Door", "High External Stone Gate", "High External Stone Wall", "High External Wooden Gate",
            "High External Wooden Wall", "High Ice Wall", "Key Lock", "Ladder Hatch", "Large Water Catcher",
            "Legacy Wood Shelter", "Metal Barricade", "Metal Shop Front", "Metal Vertical embrasure", "Metal Window Bars",
            "Metal horizontal embrasure", "Mining Quarry", "Netting", "Prison Cell Gate", "Prison Cell Wall", "Pump Jack",
            "Reinforced Glass Window", "Sandbag Barricade", "Sheet Metal Door", "Sheet Metal Double Door", "Shop Front",
            "Short Ice Wall", "Small Water Catcher", "Stone Barricade", "Strengthened Glass Window", "Tool Cupboard",
            "Triangle Ladder Hatch", "Watch Tower", "Wood Double Door", "Wood Shutters", "Wooden Barricade",
            "Wooden Barricade Cover", "Wooden Door", "Wooden Frontier Bar Doors", "Wooden Ladder", "Wooden Window Bars",
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
