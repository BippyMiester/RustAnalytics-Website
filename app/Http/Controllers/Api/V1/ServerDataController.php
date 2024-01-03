<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Server;
use App\Models\ServerData;
use DateTime;
use Illuminate\Http\Request;

class ServerDataController extends Controller
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

        $serverData = new ServerData;
        $serverData->server_id = $server->id;
        $serverData->entities = $request->entities;
        $serverData->world_seed = $request->world_seed;
        $serverData->world_name = $request->world_name;
        $serverData->players_online = $request->players_online;
        $serverData->players_max = $request->players_max;

        $dateString = "06/02/2024 12:13:51";
        $inGameTimeRaw = new DateTime($request->in_game_time);
        $inGameTime = $inGameTimeRaw->format('H:i');
        
        $serverData->in_game_time = $inGameTime;
        $serverData->server_fps = $request->server_fps;
        $serverData->map_size = $request->map_size;
        $serverData->protocol = $request->protocol;
        $serverData->used_memory = $request->used_memory;
        $serverData->max_memory = $request->max_memory;
        $serverData->network_in = $request->network_in;
        $serverData->network_out = $request->network_out;
        $serverData->last_wiped = DateTime::createFromFormat('m/d/Y H:i:s', $request->last_wiped)->format('Y-m-d H:i:s');
        $serverData->blueprint_last_wiped = DateTime::createFromFormat('m/d/Y H:i:s', $request->blueprint_last_wiped)->format('Y-m-d H:i:s');
        $serverData->save();

        print($serverData);
    }
}
