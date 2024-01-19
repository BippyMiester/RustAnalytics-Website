<?php

namespace App\Http\Controllers;

use App\Models\PlayerGather;
use App\Models\PlayerKills;
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
            // Get the current page numbers from the request
            $killsPage = $request->input('killsPage', 1);
            $gatherPage = $request->input('gatherPage', 1);
            $deathsPage = $request->input('deathsPage', 1);
            $weaponFirePage = $request->input('weaponFirePage', 1);

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
            $playerKills = $server->playerkills()->paginate(15, ['*'], 'killsPage');

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
            $playerDeaths = $server->playerdeaths()->paginate(15, ['*'], 'deathsPage');

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
            $weaponFire = $server->weaponfire()->paginate(10, ['*'], 'weaponFirePage');

            // Get the top players base on number of bullets fired
            $topBulletsFired = $this->getTopBulletsFired($server);

            // get the top weapons based on the number of bullets fired
            $topWeaponBulletsFired = $this->getTopWeaponBulletsFired($server);


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
                ->withTopWeaponBulletsFired($topWeaponBulletsFired);
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
}
