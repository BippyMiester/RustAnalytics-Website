<?php

namespace Database\Factories;

use App\Models\Server;
use App\Models\PlayerConnections;
use App\Models\PlayerData;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServerWeaponFireData>
 */
class WeaponFireFactory extends Factory
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

        $rustBullets = [
            "12 Gauge Buckshot", "12 Gauge Incendiary Shell", "12 Gauge Slug", "40mm HE Grenade", "40mm Shotgun Round",
            "40mm Smoke Grenade", "5.56 Rifle Ammo", "Bone Arrow", "Explosive 5.56 Rifle Ammo", "Fire Arrow",
            "HV 5.56 Rifle Ammo", "HV Pistol Ammo", "Handmade Shell", "High Velocity Arrow", "High Velocity Rocket",
            "Homing Missile", "Incendiary 5.56 Rifle Ammo", "Incendiary Pistol Bullet", "Incendiary Rocket", "MLRS Rocket",
            "Nailgun Nails", "Pistol Bullet", "Rocket", "SAM Ammo", "Smoke Rocket WIP", "Speargun Spear", "Torpedo",
            "Wooden Arrow"
        ];

        return [
            'server_id' => Server::factory(),
            'username' => $randomPlayer->username,
            'steam_id' => $randomPlayer->steam_id,
            'bullet' => $this->faker->randomElement($rustBullets),
            'weapon' => $this->faker->randomElement($rustWeapons),
            'amount' => $this->faker->randomNumber(3)
        ];
    }
}
