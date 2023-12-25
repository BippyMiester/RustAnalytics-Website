<?php

namespace Database\Seeders;

use App\Models\Auth\User;
use App\Models\Server;
use App\Models\ServerAnimalKillData;
use App\Models\ServerCraftingData;
use App\Models\ServerData;
use App\Models\ServerDestroyedBuildingsData;
use App\Models\ServerDestroyedContainersData;
use App\Models\ServerKillsData;
use App\Models\ServerPlacedDeployablesData;
use App\Models\ServerPlacedStructuresData;
use App\Models\ServerPlayerConnectionData;
use App\Models\ServerPlayerData;
use App\Models\ServerPlayerDeathData;
use App\Models\ServerPlayerGatherData;
use App\Models\ServerWeaponFireData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a user
        User::factory()
            ->count(25)
            ->has(
                // Give the user some servers
                Server::factory()
                    ->count(1)
                    ->has(
                        // Populate some server data
                        ServerData::factory()
                            ->count(1)
                    )
                    ->has(
                        // Put some players in the server
                        ServerPlayerConnectionData::factory()
                            ->count(5),
                        'playerconnectiondata'
                    )
                    ->has(
                        // Put some player data in
                        ServerPlayerData::factory()
                            ->count(5),
                        'playerdata'
                    )
                    ->has(
                        // Have em kill some animals
                        ServerAnimalKillData::factory()
                            ->count(10),
                        'animalkilldata'
                    )
                    // Have the craft some things
                    ->has(
                        ServerCraftingData::factory()
                            ->count(25),
                        'craftingdata'
                    )
                    // Have them die a few times for shits and giggles
                    ->has(
                        ServerPlayerDeathData::factory()
                            ->count(35),
                            'playerdeathdata'
                    )
                    // Let em blow some shit up
                    ->has(
                        ServerDestroyedBuildingsData::factory()
                            ->count(100),
                        'destroyedbuildingsdata'
                    )
                    // Maybe destroy some boxes?
                    ->has(
                        ServerDestroyedContainersData::factory()
                            ->count(50),
                        'destroyedcontainersdata'
                    )
                    // This whole time and they haven't fired their weapon? WTF!
                    ->has(
                        ServerWeaponFireData::factory()
                            ->count(500),
                            'weaponfiredata'
                    )
                    // All that shooting and stuff drained out resources
                    ->has(
                        ServerPlayerGatherData::factory()
                            ->count(250),
                            'playergatherdata'
                    )
                    // Now we can finally pvp!
                    ->has(
                        ServerKillsData::factory()
                            ->count(50),
                            'killsdata'
                    )
                    // Lets build some stuff
                    ->has(
                        ServerPlacedStructuresData::factory()
                            ->count(150),
                        'placedstructuresdata'
                    )
                    // Place some deployables down
                    ->has(
                        ServerPlacedDeployablesData::factory()
                            ->count(75),
                        'placeddeployablesdata'
                    )
            )
            ->create();
    }
}
