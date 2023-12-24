<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Server;
use App\Models\ServerPlayerConnectionData;
use Illuminate\Http\Request;

class ServerPlayerConnectionDataController extends Controller
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

        $player = new ServerPlayerConnectionData;
        $player->server_id = $server->id;
        $player->username = $request->username;
        $player->ip_address = $request->ip_address;
        $player->steam_id = $request->steam_id;
        $player->save();

        print($player);
    }

}
