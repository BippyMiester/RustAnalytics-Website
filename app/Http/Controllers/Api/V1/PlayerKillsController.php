<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\PlayerKills;
use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlayerKillsController extends Controller
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

        $playerKill = new PlayerKills;
        $playerKill->server_id = $server->id;
        $playerKill->username = $request->username;
        $playerKill->steam_id = $request->steam_id;
        $playerKill->kill_id = Str::uuid();
        $playerKill->victim = $request->victim;
        $playerKill->weapon = $request->weapon;
        $playerKill->body_part = $request->body_part;
        $playerKill->distance = $request->distance;
        $playerKill->save();

        print($playerKill);
    }
}
