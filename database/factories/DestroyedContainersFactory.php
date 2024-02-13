<?php

namespace Database\Factories;

use App\Models\Server;
use App\Models\PlayerConnections;
use App\Models\PlayerData;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServerDestroyedContainersData>
 */
class DestroyedContainersFactory extends Factory
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

        $ownerPlayer = PlayerConnections::inRandomOrder()
            ->select('username', 'steam_id')
            ->first();

        $gridList = [
            'A1', 'A2', 'A3', 'A4', 'A5', 'A6', 'A7', 'A8', 'A9', 'A10',
            'B1', 'B2', 'B3', 'B4', 'B5', 'B6', 'B7', 'B8', 'B9', 'B10',
            'C1', 'C2', 'C3', 'C4', 'C5', 'C6', 'C7', 'C8', 'C9', 'C10',
            'D1', 'D2', 'D3', 'D4', 'D5', 'D6', 'D7', 'D8', 'D9', 'D10',
            'E1', 'E2', 'E3', 'E4', 'E5', 'E6', 'E7', 'E8', 'E9', 'E10',
            'F1', 'F2', 'F3', 'F4', 'F5', 'F6', 'F7', 'F8', 'F9', 'F10',
            'G1', 'G2', 'G3', 'G4', 'G5', 'G6', 'G7', 'G8', 'G9', 'G10',
            'H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8', 'H9', 'H10',
            'I1', 'I2', 'I3', 'I4', 'I5', 'I6', 'I7', 'I8', 'I9', 'I10',
            'J1', 'J2', 'J3', 'J4', 'J5', 'J6', 'J7', 'J8', 'J9', 'J10',
            'K1', 'K2', 'K3', 'K4', 'K5', 'K6', 'K7', 'K8', 'K9', 'K10',
            'L1', 'L2', 'L3', 'L4', 'L5', 'L6', 'L7', 'L8', 'L9', 'L10',
            'M1', 'M2', 'M3', 'M4', 'M5', 'M6', 'M7', 'M8', 'M9', 'M10'
        ];

        $rustWeapons = [
            "Assault Rifle", "Beancan Grenade", "Bolt Action Rifle", "Bone Club", "Bone Knife", "Butcher Knife",
            "Candy Cane Club", "Combat Knife", "Compound Bow", "Crossbow", "Custom SMG", "Double Barrel Shotgun",
            "Eoka Pistol", "F1 Grenade", "Flame Thrower", "Flashbang", "HMLMG", "Hunting Bow", "L96 Rifle",
            "LR-300 Assault Rifle", "Longsword", "M249", "M39 Rifle", "M4 Shotgun", "M92 Pistol", "MP5A4", "Mace",
            "Machete", "Molotov Cocktail", "Multiple Grenade Launcher", "Nailgun", "Paddle", "Pitchfork", "Prototype 17",
            "Pump Shotgun", "Python Revolver", "Revolver", "Rocket Launcher", "Salvaged Cleaver", "Salvaged Sword",
            "Semi-Automatic Pistol", "Semi-Automatic Rifle", "Skinning Knife", "Snowball", "Snowball Gun", "Spas-12 Shotgun",
            "Speargun", "Stone Spear", "Thompson", "Vampire Stake", "Water Gun", "Water Pistol", "Waterpipe Shotgun",
            "Wooden Spear"
        ];

        $rustStorageContainers = [
            "Large Wood Box", "Wood Storage Box", "Locker", "Tool Cupboard", "Vending Machine",
            "Storage Barrel Horizontal", "Storage Barrel Vertical", "Drop Box", "Small Stash"
        ];

        return [
            'server_id' => Server::factory(),
            'username' => $randomPlayer->username,
            'steam_id' => $randomPlayer->steam_id,
            'owner' => $ownerPlayer->username,
            'type' => $this->faker->randomElement($rustStorageContainers),
            'weapon' => $this->faker->randomElement($rustWeapons),
            'grid' => $this->faker->randomElement($gridList),
            'x' => $this->faker->numberBetween(-5000, 5000),
            'y' => $this->faker->numberBetween(-5000, 5000),
            'created_at' => $this->faker->dateTimeThisMonth()
        ];
    }
}
