<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\AnimalKills;
use App\Models\PlayerDeaths;
use App\Models\Server;
use Illuminate\Http\Request;

class PlayerDeathsController extends Controller
{
    private function sendResponseCode(int $code, string $msg) {
        return response()->json(['Response Message' => $msg], $code);
    }

    public function create(Request $request) {
        // Check if request is null
        if($request->all() == null) {
            return $this->sendResponseCode(400, 'Data is null!');
        }

        // Grab the Server via the api Key
        $server = Server::where('api_key', $request->api_key)->first();
        if(!$server) {
            return $this->sendResponseCode(400, 'Server API Key Invalid. Check your API key and try again.');
        }

        $playerDeath = new PlayerDeaths;
        $playerDeath->server_id = $server->id;
        $playerDeath->username = $request->username;
        $playerDeath->steam_id = $request->steam_id;
        $playerDeath->cause = $request->cause;
        $playerDeath->x = $request->x;
        $playerDeath->y = $request->y;
        $playerDeath->grid = $request->grid;
        $playerDeath->save();

        print($playerDeath);
    }
}
