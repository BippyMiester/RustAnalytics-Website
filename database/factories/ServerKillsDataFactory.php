<?php

namespace Database\Factories;

use App\Models\Server;
use App\Models\ServerPlayerConnectionData;
use App\Models\ServerPlayerData;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServerKillsData>
 */
class ServerKillsDataFactory extends Factory
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

        $victimPlayer = ServerPlayerConnectionData::inRandomOrder()
            ->select('username', 'steam_id')
            ->first();

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

        return [
            'server_id' => Server::factory(),
            'username' => $randomPlayer->username,
            'steam_id' => $randomPlayer->steam_id,
            'kill_id' => $this->faker->randomNumber(8, true),
            'victim' => $victimPlayer->username,
            'weapon' => $this->faker->randomElement($rustWeapons),
            'body_part' => $this->faker->randomElement(['arm', 'head', 'torso', 'leg']),
            'distance' => $this->faker->numberBetween(1,250)
        ];
    }
}
