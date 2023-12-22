<?php

namespace Database\Seeders;

use App\Models\Auth\User;
use App\Models\Server;
use App\Models\ServerAnimalKillData;
use App\Models\ServerCraftingData;
use App\Models\ServerData;
use App\Models\ServerPlayerData;
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
            ->count(rand(5,10))
            ->has(
                // Give the user some servers
                Server::factory()
                    ->count(5)
                    ->has(
                        // Populate some server data
                        ServerData::factory()
                            ->count(rand(5,20))
                    )
                    ->has(
                        // Put some players in the server
                        ServerPlayerData::factory()
                            ->count(rand(2,25)),
                        'playerdata'
                    )
                    ->has(
                        // Have em kill some animals
                        ServerAnimalKillData::factory()
                            ->count(rand(5,20)),
                        'animalkilldata'
                    )
                    // Have the craft some things
                    ->has(
                        ServerCraftingData::factory()
                            ->count(rand(10,25)),
                        'craftingdata'
                    )
            )
            ->create();
    }
}
