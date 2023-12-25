<?php

namespace Database\Seeders;

use App\Models\AnimalKills;
use App\Models\Auth\User;
use App\Models\DestroyedBuildings;
use App\Models\PlayerCrafting;
use App\Models\PlayerTime;
use App\Models\Server;
use App\Models\ServerAnimalKillData;
use App\Models\ServerCraftingData;
use App\Models\ServerData;
use App\Models\ServerDestroyedBuildingsData;
use App\Models\DestroyedContainers;
use App\Models\PlayerKills;
use App\Models\PlacedDeployables;
use App\Models\PlacedStructures;
use App\Models\PlayerConnections;
use App\Models\PlayerData;
use App\Models\PlayerDeaths;
use App\Models\PlayerGather;
use App\Models\WeaponFire;
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
                        PlayerConnections::factory()
                            ->count(5)
                            ->has(
                            // Put some player data in
                                PlayerTime::factory()
                                    ->count(5),
                                'playertime'
                            ),
                        'playerconnections'
                    )
                    ->has(
                        // Put some player data in
                        PlayerData::factory()
                            ->count(5),
                        'playerdata'
                    )
                    ->has(
                        // Have em kill some animals
                        AnimalKills::factory()
                            ->count(10),
                        'animalkills'
                    )
                    // Have the craft some things
                    ->has(
                        PlayerCrafting::factory()
                            ->count(25),
                        'playercrafting'
                    )
                    // Have them die a few times for shits and giggles
                    ->has(
                        PlayerDeaths::factory()
                            ->count(35),
                            'playerdeaths'
                    )
                    // Let em blow some shit up
                    ->has(
                        DestroyedBuildings::factory()
                            ->count(100),
                        'destroyedbuildings'
                    )
                    // Maybe destroy some boxes?
                    ->has(
                        DestroyedContainers::factory()
                            ->count(50),
                        'destroyedcontainers'
                    )
                    // This whole time and they haven't fired their weapon? WTF!
                    ->has(
                        WeaponFire::factory()
                            ->count(500),
                            'weaponfire'
                    )
                    // All that shooting and stuff drained out resources
                    ->has(
                        PlayerGather::factory()
                            ->count(250),
                            'playergather'
                    )
                    // Now we can finally pvp!
                    ->has(
                        PlayerKills::factory()
                            ->count(50),
                            'playerkills'
                    )
                    // Lets build some stuff
                    ->has(
                        PlacedStructures::factory()
                            ->count(150),
                        'placedstructures'
                    )
                    // Place some deployables down
                    ->has(
                        PlacedDeployables::factory()
                            ->count(75),
                        'placeddeployables'
                    )
            )
            ->create();
    }
}
