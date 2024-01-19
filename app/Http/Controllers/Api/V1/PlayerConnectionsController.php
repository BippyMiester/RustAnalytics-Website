<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Server;
use App\Models\PlayerConnections;
use Illuminate\Http\Request;

class PlayerConnectionsController extends Controller
{

    private function sendResponseCode(int $code, string $msg) {
        return response()->json(['Response Message' => $msg], $code);
    }

    public function create(Request $request) {
        // Check if request is null
        if($request->all() == null) {
            return $this->sendResponseCode(400, 'RA_ERROR_NULL: (PlayerConnectionsController) Player Connections Data is Null!');
        }

        // Grab the Server via the api Key
        $server = Server::where('api_key', $request->api_key)->first();
        if(!$server) {
            return $this->sendResponseCode(400, 'Server API Key Invalid. Check your API key and try again.');
        }

        $player = new PlayerConnections;
        $player->server_id = $server->id;
        $player->username = $request->username;
        $player->ip_address = $request->ip_address;
        $player->steam_id = $request->steam_id;
        $player->online_seconds = $request->online_seconds;
        $player->afk_seconds = $request->afk_seconds;
        $player->type = $request->type;
        $player->save();

        print($player);
    }

}
