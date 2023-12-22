<?php

namespace Database\Seeders;

use App\Models\Auth\User;
use App\Models\Server;
use App\Models\ServerAnimalKillData;
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
        User::factory()
            ->count(rand(5,10))
            ->has(
                Server::factory()
                    ->count(5)
                    ->has(
                        ServerData::factory()
                            ->count(rand(5,20))
                    )
                    ->has(
                        ServerPlayerData::factory()
                            ->count(rand(2,25)),
                        'playerdata'
                    )
                    ->has(
                        ServerAnimalKillData::factory()
                            ->count(rand(5,20)),
                        'animalkilldata'
                    )
            )
            ->create();
    }
}
