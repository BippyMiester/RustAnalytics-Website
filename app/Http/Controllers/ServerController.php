<?php

namespace App\Http\Controllers;

use App\Models\PlayerGather;
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
            // Get the player count total for the server
            $uniquePlayerCount = $server->players()
                ->distinct('steam_id')
                ->count('steam_id');

            // Get the list of players for the server
            $players = $this->getPlayersList($server);

            // Get the player Gather Data
            $playerGatherAll = PlayerGather::where('server_id', $server->id)->get();

            // Get The Player Raw Gather Data
            $playerGather = $this->getPlayerGatherData($request, $playerGatherAll);

            // Get the total amount of collected resources across all players
            $totalAmountsByResource = $playerGatherAll->groupBy('resource')
                ->map(function ($items, $resource) {
                    return $items->sum('amount');
                })->toArray();

            // Get the top collectors for each resource
            $topCollectors = $this->getTopCollectors($playerGatherAll);

            return view('user.server.show')
                ->withServer($server)
                ->withPlayerCount($uniquePlayerCount)
                ->withPlayers($players)
                ->withPlayerGather($playerGather)
                ->withTotalAmountsByResource($totalAmountsByResource)
                ->withTopCollectors($topCollectors);
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
}
