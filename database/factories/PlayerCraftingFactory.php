<?php

namespace Database\Factories;

use App\Models\Server;
use App\Models\PlayerConnections;
use App\Models\PlayerData;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServerCraftingData>
 */
class PlayerCraftingFactory extends Factory
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

        $rustCraftableItems = [
            "Binoculars", "Birthday Cake", "Camera", "Chainsaw", "Fishing Tackle", "Flare",
            "Flashlight", "Garry's Mod Tool Gun", "Geiger Counter", "Hammer", "Handmade Fishing Rod",
            "Hatchet", "Instant Camera", "Jackhammer", "Pickaxe", "RF Transmitter", "Rock",
            "Salvaged Axe", "Salvaged Hammer", "Salvaged Icepick", "Satchel Charge", "Smoke Grenade",
            "Spray Can", "Stone Hatchet", "Stone Pickaxe", "Supply Signal", "Survey Charge",
            "Timed Explosive Charge", "Torch", "Water Bucket", "Anti-Radiation Pills", "Bandage",
            "Blood", "Large Medkit", "Medical Syringe", "Adv. Anti-Rad Tea", "Advanced Healing Tea",
            "Water Barrel", "Locker", "Mail Box", "Mixing Table", "Small Oil Refinery",
            "Large Planter Box", "Small Planter Box", "Repair Bench", "Research Table", "Rug Bear Skin",
            "Rug", "Secret Lab Chair", "Salvaged Shelves", "Large Banner Hanging", "Two Sided Hanging Sign"
        ];

        return [
            'server_id' => Server::factory(),
            'username' => $randomPlayer->username,
            'steam_id' => $randomPlayer->steam_id,
            'item_crafted' => $this->faker->randomElement($rustCraftableItems),
            'amount' => $this->faker->numberBetween(1, 150)
        ];
    }
}
