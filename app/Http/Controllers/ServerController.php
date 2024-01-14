<?php

namespace App\Http\Controllers;

use App\Models\Server;
use Illuminate\Http\Request;
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

    public function show(string $slug) {
        $server = Server::where('slug', $slug)->where('user_id', Auth::id())->first();

        if($server) {
            $uniquePlayerCount = $server->players()
                ->distinct('steam_id')
                ->count('steam_id');

            $uniqueSteamIds = $server->players()->select('steam_id')->distinct()->pluck('steam_id');

            $players = collect();
            foreach ($uniqueSteamIds as $steamId) {
                $latestEntry = $server->players()->where('steam_id', $steamId)
                    ->latest()
                    ->first();
                $players->push($latestEntry);
            }

            return view('user.server.show')
                ->withServer($server)
                ->withPlayerCount($uniquePlayerCount)
                ->withPlayers($players);
        }

        return abort(404);
    }
}
