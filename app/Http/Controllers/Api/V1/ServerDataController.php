<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\ServerDataUpdateEvent;
use App\Http\Controllers\Controller;
use App\Models\PusherTimeout;
use App\Models\Server;
use App\Models\ServerData;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class ServerDataController extends Controller
{
    private function sendResponseCode(int $code, string $msg) {
        return response()->json(['Response Message' => $msg], $code);
    }

    public function create(Request $request) {
        // Check if request is null
        if($request->all() == null) {
            return $this->sendResponseCode(400, 'RA_ERROR_NULL: (ServerDataController) Server Data is Null!');
        }

        // Grab the Server via the api Key
        $server = Server::where('api_key', $request->api_key)->first();
        if(!$server) {
            return $this->sendResponseCode(400, 'Server API Key Invalid. Check your API key and try again.');
        }

        $executed = RateLimiter::attempt(
            'serverUpdate:'.$request->api_key,
            $perMinute = 2,
            function() {}
        );

        if (!$executed) {
            return $this->sendResponseCode(429, 'Rate limit exceeded');
        }

        $serverData = new ServerData;
        $serverData->server_id = $server->id;
        $serverData->entities = $request->entities;
        $serverData->players_online = $request->players_online;
        $serverData->players_max = $request->players_max;

        $inGameTimeRaw = new DateTime($request->in_game_time);
        $inGameTime = $inGameTimeRaw->format('H:i');
        $serverData->in_game_time = $inGameTime;

        $serverData->server_fps = $request->server_fps;
        $serverData->used_memory = round($request->used_memory, 2);
        $serverData->max_memory = round($request->max_memory, 2);
        $serverData->network_in = $request->network_in;
        $serverData->network_out = $request->network_out;
        $serverData->save();

        $timeout = PusherTimeout::where('api_key', $server->api_key)->first();
        if($timeout->server_data_count < 10) {
            event(new ServerDataUpdateEvent($server));
            $timeout->server_data_count = $timeout->server_data_count + 1;
            $timeout->save();
        }

        print($serverData);
    }
}
