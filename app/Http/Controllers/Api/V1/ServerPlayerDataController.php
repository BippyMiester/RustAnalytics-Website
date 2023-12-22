<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ApiTest;
use App\Models\Server;
use App\Models\ServerPlayerData;
use Illuminate\Http\Request;

class ServerPlayerDataController extends Controller
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

        $player = new ServerPlayerData;
        $player->server_id = $server->id;
        $player->username = $request->username;
        $player->ip_address = $request->ip_address;
        $player->steam_id = $request->steam_id;
        $player->frame_rate = 1;
        $player->packet_loss = 1;
        $player->online_seconds = $request->online_seconds;
        $player->afk_seconds = $request->afk_seconds;
        $player->save();

        print($player);
    }
}
