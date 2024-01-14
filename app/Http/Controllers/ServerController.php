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
        $uniquePlayerCount = $server->players()
            ->distinct('steam_id')
            ->count('steam_id');

        if($server) {
            return view('user.server.show')
                ->withServer($server)
                ->withPlayerCount($uniquePlayerCount);
        }

        return abort(404);
    }
}
