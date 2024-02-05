<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PusherTimeout;
use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class DashboardServerController extends Controller
{

    public function show(Request $request, string $slug) {
        $server = Server::where('slug', $slug)->where('user_id', Auth::id())->first();

        if($server) {
            // Reset the timeout
            $timeout = PusherTimeout::where('api_key', $server->api_key)->first();
            $timeout->server_data_count = 0;
            $timeout->save();

            // Get the player count total for the server
            $uniquePlayerCount = $this->getUniquePlayerCount($server);

            return view('user.dashboard.server.show')
                ->withServer($server)
                ->withUniquePlayerCount($uniquePlayerCount);
        }

        return abort(404);
    }

    public function animalkills(Request $request, string $slug) {
        $server = Server::where('slug', $slug)->where('user_id', Auth::id())->first();

        if($server) {
            // Get all the animal kills
            $animalKillsAll = $server->animalkills()->get();
            $animalKills = $server->animalkills()->orderBy('created_at', 'desc')->paginate(10);

            // Get top animals being killed
            $topAnimalKills = $this->getTopAnimalKills($animalKillsAll);

            // Get top weapons being used for killing
            $topAnimalKillsWeapons = $this->getTopAnimalKillsWeapons($animalKillsAll);

            // get the top animal kills sorted by username
            $topAnimalKillsUsers = $this->getTopAnimalKillsUsers($animalKillsAll);

            return view('user.dashboard.server.animalkills')
                    ->withServer($server)
                    ->withAnimalKills($animalKills)
                    ->withTopAnimalKills($topAnimalKills)
                    ->withTopAnimalKillsWeapons($topAnimalKillsWeapons)
                    ->withTopAnimalKillsUsers($topAnimalKillsUsers);
        }

        return abort(404);

    }

    // Helper Functions
    private function getPlayersList($server)
    {
        $uniqueSteamIds = $server->players()->select('steam_id')->distinct()->pluck('steam_id');
        $players = collect();
        foreach ($uniqueSteamIds as $steamId) {
            $latestEntry = $server->players()->where('steam_id', $steamId)
                ->latest()
                ->first();
            $players->push($latestEntry);
        }
        return $players;
    }

    private function getPlayerGatherData(Request $request, $playerGatherAll)
    {
        // Flatten the structure into a single collection of items
        $items = new Collection();
        $playerGatherAll->groupBy('username')
            ->each(function ($userGatherings) use ($items) {
                $userGatherings->groupBy('resource')
                    ->each(function ($resourceGroup) use ($items) {
                        if ($resourceGroup->isNotEmpty()) {
                            $items->push([
                                'username' => $resourceGroup->first()->username,
                                'steam_id' => $resourceGroup->first()->steam_id,
                                'resource' => $resourceGroup->first()->resource,
                                'total_amount' => $resourceGroup->sum('amount')
                            ]);
                        }
                    });
            });

        // Manual pagination
        $perPage = 5;
        $page = $request->input('gatherPage', 1); // Get the current page from 'gatherPage' parameter
        $total = $items->count();
        $results = $items->forPage($page, $perPage)->values();

        // Set the current page resolver to use 'gatherPage'
        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        return new LengthAwarePaginator($results, $total, $perPage, $page, [
            'path' => $request->url(),
            'pageName' => 'gatherPage'
        ]);

    }

    private function getTopCollectors($playerGatherAll)
    {
        // Group by resource, then find the top collector for each resource
        return $playerGatherAll->groupBy('resource')
            ->map(function ($groupedByResource) {
                return $groupedByResource
                    ->groupBy('username')
                    ->map(function ($groupedByUser) {
                        return $groupedByUser->sum('amount');
                    })
                    ->sortDesc()
                    ->map(function ($amount, $username) {
                        return compact('username', 'amount');
                    })
                    ->first();
            });
    }

    private function getUniquePlayerCount($server)
    {
        return $server->players()
            ->distinct('steam_id')
            ->count('steam_id');
    }

    private function getTotalAmountsByResource($playerGatherAll)
    {
        return $playerGatherAll->groupBy('resource')
            ->map(function ($items, $resource) {
                return $items->sum('amount');
            })->toArray();
    }

    private function getTopPlayerKills($playerKillsAll)
    {
        return $playerKillsAll
            ->groupBy('username')
            ->map(function ($kills, $username) {
                return [
                    'username' => $username,
                    'kill_count' => $kills->count(),
                ];
            })
            ->sortByDesc('kill_count')
            ->take(10);
    }

    private function getTopPlayerKillsWeapons($playerKillsAll)
    {
        return $playerKillsAll
            ->groupBy('weapon')
            ->map(function ($kills, $weapon) {
                return [
                    'weapon' => $weapon,
                    'count' => $kills->count(),
                ];
            })
            ->sortByDesc('count')
            ->take(10);
    }

    private function getTopPlayerDeaths($playerDeathsAll)
    {
        return $playerDeathsAll
            ->groupBy('steam_id')
            ->map(function ($deaths, $steam_id) {
                return [
                    'username' => $deaths->first()->username, // Assuming the username is consistent for each steam_id
                    'death_count' => $deaths->count(),
                ];
            })
            ->sortByDesc('death_count')
            ->take(10);
    }

    private function getTopPlayerDeathsCause($playerDeathsAll)
    {
        return $playerDeathsAll
            ->groupBy('cause')
            ->map(function ($deaths, $cause) {
                return [
                    'cause' => $cause,
                    'count' => $deaths->count(),
                ];
            })
            ->sortByDesc('count')
            ->take(10);
    }

    private function getTopPlayerDeathGrid($playerDeathsAll)
    {
        return $playerDeathsAll
            ->groupBy('grid')
            ->map(function ($deaths, $grid) {
                return [
                    'grid' => $grid,
                    'count' => $deaths->count(),
                ];
            })
            ->sortByDesc('count')
            ->take(10);
    }

    private function getKillsBodyPartChart($playerKillsAll)
    {
        return $playerKillsAll->groupBy('body_part')
            ->map(function ($items, $bodyPart) {
                return [
                    'body_part' => $bodyPart,
                    'count' => $items->count(),
                ];
            })->values()->toArray();
    }

    private function getTopPlayerKillDistances($playerKillsAll)
    {
        return $playerKillsAll
            ->sortByDesc('distance')
            ->take(10)
            ->map(function ($kill) {
                return [
                    'username' => $kill->username,
                    'distance' => $kill->distance,
                ];
            });
    }

    private function getTopBulletsFired($server)
    {
        return $server->weaponfire()
            ->select('username', 'steam_id')
            ->selectRaw('SUM(amount) as total_bullets')
            ->groupBy('username', 'steam_id')
            ->orderByDesc('total_bullets')
            ->take(10)
            ->get();
    }

    private function getTopWeaponBulletsFired($server)
    {
        return $server->weaponfire()
            ->select('weapon')
            ->selectRaw('SUM(amount) as total_bullets')
            ->groupBy('weapon')
            ->orderByDesc('total_bullets')
            ->take(10)
            ->get();
    }

    private function getTopDestroyedBuildingTypes($destroyedBuildingsAll)
    {
        return $destroyedBuildingsAll
            ->groupBy('type')
            ->map(function ($items, $type) {
                return [
                    'type' => $type,
                    'count' => $items->count(),
                ];
            })
            ->sortByDesc('count')
            ->take(10)
            ->values();
    }

    private function getTopDestroyers($destroyedBuildingsAll)
    {
        return $destroyedBuildingsAll
            ->groupBy('username') // or 'steam_id' if you prefer to group by steam_id
            ->map(function ($group, $username) {
                return [
                    'username' => $username,
                    'count' => $group->count() // Count the number of entries for each player
                ];
            })
            ->sortByDesc('count') // Sort by count in descending order
            ->values() // Reset the keys to make it sequential
            ->take(10); // Take the top 10 players
    }

    private function getMostDestructiveBuildingWeapons($destroyedBuildingsAll)
    {
        return $destroyedBuildingsAll
            ->groupBy('weapon')
            ->map(function ($group, $weapon) {
                return [
                    'weapon' => $weapon,
                    'count' => $group->count()
                ];
            })
            ->sortByDesc('count')
            ->values()
            ->take(10);
    }

    private function getTopDestroyedContainers($destroyedContainersAll)
    {
        return $destroyedContainersAll
            ->groupBy('type')
            ->map(function ($group, $type) {
                return [
                    'type' => $type,
                    'count' => $group->count()
                ];
            })
            ->sortByDesc('count')
            ->values()
            ->take(10);
    }

    private function getTopContainerDestroyers($destroyedContainersAll)
    {
        return $destroyedContainersAll
            ->groupBy('username') // or 'steam_id' if you prefer to group by steam_id
            ->map(function ($group, $username) {
                return [
                    'username' => $username,
                    'count' => $group->count() // Count the number of entries for each player
                ];
            })
            ->sortByDesc('count') // Sort by count in descending order
            ->values() // Reset the keys to make it sequential
            ->take(10); // Take the top 10 players
    }

    private function getMostDestructiveContainerWeapons($destroyedContainersAll)
    {
        return $destroyedContainersAll
            ->groupBy('weapon')
            ->map(function ($group, $weapon) {
                return [
                    'weapon' => $weapon,
                    'count' => $group->count()
                ];
            })
            ->sortByDesc('count')
            ->values()
            ->take(10);
    }

    private function getTopPlacedStructures($placedStructuresAll)
    {
        return $placedStructuresAll
            ->groupBy('type')
            ->map(function ($group, $type) {
                return [
                    'type' => $type,
                    'count' => $group->count()
                ];
            })
            ->sortByDesc('count')
            ->values()
            ->take(10);
    }

    private function getTopPlacedStructuresPlayers($placedStructuresAll)
    {
        return $placedStructuresAll
            ->groupBy('username') // or 'steam_id' if you prefer to group by steam_id
            ->map(function ($group, $username) {
                return [
                    'username' => $username,
                    'count' => $group->count() // Count the number of entries for each player
                ];
            })
            ->sortByDesc('count') // Sort by count in descending order
            ->values() // Reset the keys to make it sequential
            ->take(10); // Take the top 10 players
    }

    private function getTopPlacedDeployables($placedDeployablesAll)
    {
        return $placedDeployablesAll
            ->groupBy('type')
            ->map(function ($group, $type) {
                return [
                    'type' => $type,
                    'count' => $group->count()
                ];
            })
            ->sortByDesc('count')
            ->values()
            ->take(10);
    }

    private function getTopPlacedDeployablesPlayers($placedDeployablesAll)
    {
        return $placedDeployablesAll
            ->groupBy('username') // or 'steam_id' if you prefer to group by steam_id
            ->map(function ($group, $username) {
                return [
                    'username' => $username,
                    'count' => $group->count() // Count the number of entries for each player
                ];
            })
            ->sortByDesc('count') // Sort by count in descending order
            ->values() // Reset the keys to make it sequential
            ->take(10); // Take the top 10 players
    }

    private function getTopAnimalKills($animalKillsAll)
    {
        return $animalKillsAll->groupBy('animal_type')
            ->map(function ($kills, $type) {
                return [
                    'type' => $type,
                    'count' => $kills->count()
                ];
            })
            ->values() // Reset the keys to ensure a 0-indexed array for iteration
            ->sortByDesc('count'); // Sort by count, descending
    }

    private function getTopAnimalKillsWeapons($animalKillsAll)
    {
        return $animalKillsAll->groupBy('weapon')
            ->map(function ($items, $weapon) {
                return ['weapon' => $weapon, 'count' => $items->count()];
            })
            ->sortByDesc('count')
            ->take(10)
            ->values() // Reindex array
            ->all();
    }

    private function getTopAnimalKillsUsers($animalKillsAll)
    {
        return $animalKillsAll->groupBy('username')
            ->map(function ($kills, $username) {
                return ['username' => $username, 'count' => $kills->count()];
            })
            ->sortByDesc('count')
            ->take(10)
            ->values() // Reset keys after sorting and taking top 10
            ->all();
    }
}
