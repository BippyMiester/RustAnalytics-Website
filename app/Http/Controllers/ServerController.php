<?php

namespace App\Http\Controllers;

use App\Models\PusherTimeout;
use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ServerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Request $request, string $slug) {
        $server = Server::where('slug', $slug)->where('user_id', Auth::id())->first();

        if($server) {
            // Reset the timeout
            $timeout = PusherTimeout::where('api_key', $server->api_key)->first();
            $timeout->server_data_count = 0;
            $timeout->save();

            // Get the current page numbers from the request
            $killsPage = $request->input('killsPage', 1);
            $gatherPage = $request->input('gatherPage', 1);
            $deathsPage = $request->input('deathsPage', 1);
            $weaponFirePage = $request->input('weaponFirePage', 1);
            $destroyedBuildingsPage = $request->input('destroyedBuildingsPage', 1);
            $destroyedContainersPage = $request->input('destroyedContainersPage', 1);
            $placedStructuresPage = $request->input('placedStructuresPage', 1);
            $placedDeployablesPage = $request->input('placedDeployablesPage', 1);

            // Get the player count total for the server
            $uniquePlayerCount = $this->getUniquePlayerCount($server);

            // Get the list of players for the server
            $players = $this->getPlayersList($server);

            // Set up pagination for PlayerGather
            Paginator::currentPageResolver(function () use ($gatherPage) {
                return $gatherPage;
            });

            // Get the player Gather Data
            $playerGatherAll = $server->playergather()->get();

            // Get The Player Raw Gather Data
            $playerGather = $this->getPlayerGatherData($request, $playerGatherAll);

            // Get the total amount of collected resources across all players
            $totalAmountsByResource = $this->getTotalAmountsByResource($playerGatherAll);

            // Get the top collectors for each resource
            $topCollectors = $this->getTopCollectors($playerGatherAll);

            // Set up pagination for PlayerKills
            Paginator::currentPageResolver(function () use ($killsPage) {
                return $killsPage;
            });

            // Get the player Kills Data
            $playerKillsAll = $server->playerkills()->get();
            $playerKills = $server->playerkills()->orderBy('created_at', 'desc')->paginate(15, ['*'], 'killsPage');

            // Top Player Kills
            $topPlayerKills = $this->getTopPlayerKills($playerKillsAll);

            // Get Top Player Kills Weapon Count
            $topPlayerKillsWeapons = $this->getTopPlayerKillsWeapons($playerKillsAll);

            // Set up pagination for PlayerDeaths
            Paginator::currentPageResolver(function () use ($deathsPage) {
                return $deathsPage;
            });

            // Get the player deaths data
            $playerDeathsAll = $server->playerdeaths()->get();
            $playerDeaths = $server->playerdeaths()->orderBy('created_at', 'desc')->paginate(15, ['*'], 'deathsPage');

            // Get the top player deaths
            $topPlayerDeaths = $this->getTopPlayerDeaths($playerDeathsAll);

            // Get Top Player Deaths Cause Count
            $topPlayerDeathsCause = $this->getTopPlayerDeathsCause($playerDeathsAll);

            // Get Player Death Top 10 Most Common Grid Locations
            $topPlayerDeathGrid = $this->getTopPlayerDeathGrid($playerDeathsAll);

            // Get the array of data to be used by the body part chart
            $killsBodyPartChart = $this->getKillsBodyPartChart($playerKillsAll);

            // Get the top player kill distances
            $topPlayerKillDistances = $this->getTopPlayerKillDistances($playerKillsAll);

            // Set up pagination for Weapon Fire
            Paginator::currentPageResolver(function () use ($weaponFirePage) {
                return $weaponFirePage;
            });

            // Get the player weapon Fire
            $weaponFireAll = $server->weaponfire()->get();
            $weaponFire = $server->weaponfire()->orderBy('created_at', 'desc')->paginate(10, ['*'], 'weaponFirePage');

            // Get the top players base on number of bullets fired
            $topBulletsFired = $this->getTopBulletsFired($server);

            // get the top weapons based on the number of bullets fired
            $topWeaponBulletsFired = $this->getTopWeaponBulletsFired($server);


            // Set up pagination for Destroyed Buildings
            Paginator::currentPageResolver(function () use ($destroyedBuildingsPage) {
                return $destroyedBuildingsPage;
            });

            // Get all the destroyed buildings
            $destroyedBuildingsAll = $server->destroyedbuildings()->get();
            $destroyedBuildings = $server->destroyedbuildings()->orderBy('created_at', 'desc')->paginate(10, ['*'], 'destroyedBuildingsPage');

            // Get the top destroyed building types
            $topDestroyedBuildingTypes = $this->getTopDestroyedBuildingTypes($destroyedBuildingsAll);

            // get the top destroyers on the server
            $topDestroyers = $this->getTopDestroyers($destroyedBuildingsAll);

            // Get the most destructive weapons for buildings
            $mostDestructiveBuildingWeapons = $this->getMostDestructiveBuildingWeapons($destroyedBuildingsAll);

            // Set up pagination for Destroyed Containers
            Paginator::currentPageResolver(function () use ($destroyedContainersPage) {
                return $destroyedContainersPage;
            });

            // Get all the destroyed containers
            $destroyedContainersAll = $server->destroyedcontainers()->get();
            $destroyedContainers = $server->destroyedcontainers()->orderBy('created_at', 'desc')->paginate(10, ['*'], 'destroyedContainersPage');

            // Get the top destroyed containers
            $topDestroyedContainers = $this->getTopDestroyedContainers($destroyedContainersAll);

            // Get Top destroyers of containers
            $topContainerDestroyers = $this->getTopContainerDestroyers($destroyedContainersAll);

            // Get most destructive container weapons
            $mostDestructiveContainerWeapons = $this->getMostDestructiveContainerWeapons($destroyedContainersAll);

            // Set up pagination for Placed structures
            Paginator::currentPageResolver(function () use ($placedStructuresPage) {
                return $placedStructuresPage;
            });

            // get all the placed structures
            $placedStructuresAll = $server->placedstructures()->get();
            $placedStructures = $server->placedstructures()->orderBy('created_at', 'desc')->paginate(10, ['*'], 'placedStructuresPage');

            // top placed structures
            $topPlacedStructures = $this->getTopPlacedStructures($placedStructuresAll);

            // top placed structures by username
            $topPlacedStructuresPlayers = $this->getTopPlacedStructuresPlayers($placedStructuresAll);

            // Set up pagination for Placed Deployables
            Paginator::currentPageResolver(function () use ($placedDeployablesPage) {
                return $placedDeployablesPage;
            });

            // Get all the placed deployables
            $placedDeployablesAll = $server->placeddeployables()->get();
            $placedDeployables = $server->placeddeployables()->orderBy('created_at', 'desc')->paginate(10, ['*'], 'placedDeployablesPage');

            // top placed deployables
            $topPlacedDeployables = $this->getTopPlacedDeployables($placedDeployablesAll);

            // top placed deployables by username
            $topPlacedDeployablesPlayers = $this->getTopPlacedDeployablesPlayers($placedDeployablesAll);

            return view('user.server.show')
                ->withServer($server)
                ->withPlayerCount($uniquePlayerCount)
                ->withPlayers($players)
                ->withPlayerGather($playerGather)
                ->withTotalAmountsByResource($totalAmountsByResource)
                ->withTopCollectors($topCollectors)
                ->withPlayerKills($playerKills)
                ->withTopPlayerKills($topPlayerKills)
                ->withTopPlayerKillsWeapons($topPlayerKillsWeapons)
                ->withPlayerDeaths($playerDeaths)
                ->withTopPlayerDeaths($topPlayerDeaths)
                ->withTopPlayerDeathsCause($topPlayerDeathsCause)
                ->withTopPlayerDeathGrid($topPlayerDeathGrid)
                ->withKillsBodyPartChart($killsBodyPartChart)
                ->withTopPlayerKillDistances($topPlayerKillDistances)
                ->withWeaponFire($weaponFire)
                ->withTopBulletsFired($topBulletsFired)
                ->withTopWeaponBulletsFired($topWeaponBulletsFired)
                ->withDestroyedBuildings($destroyedBuildings)
                ->withTopDestroyedBuildingTypes($topDestroyedBuildingTypes)
                ->withTopDestroyers($topDestroyers)
                ->withMostDestructiveBuildingWeapons($mostDestructiveBuildingWeapons)
                ->withDestroyedContainers($destroyedContainers)
                ->withTopDestroyedContainers($topDestroyedContainers)
                ->withTopContainerDestroyers($topContainerDestroyers)
                ->withMostDestructiveContainerWeapons($mostDestructiveContainerWeapons)
                ->withPlacedStructures($placedStructures)
                ->withTopPlacedStructures($topPlacedStructures)
                ->withTopPlacedStructuresPlayers($topPlacedStructuresPlayers)
                ->withPlacedDeployables($placedDeployables)
                ->withTopPlacedDeployables($topPlacedDeployables)
                ->withTopPlacedDeployablesPlayers($topPlacedDeployablesPlayers);
        }

        return abort(404);
    }

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
}
