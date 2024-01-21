<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Server;
use App\Models\Settings;
use DateTime;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    private function sendResponseCode(int $code, string $msg) {
        return response()->json(['Response Message' => $msg], $code);
    }

    public function getRefreshRate(Request $request) {
        // Check if request is null
        if($request->all() == null) {
            return $this->sendResponseCode(400, 'RA_ERROR_NULL: (ServerController) Server Data is Null!');
        }

        // Grab the Server via the api Key
        $server = Server::where('api_key', $request->api_key)->first();
        if(!$server) {
            return $this->sendResponseCode(400, 'Server API Key Invalid. Check your API key and try again.');
        }

        return $server->refresh_rate;
    }

    public function update(Request $request) {

        // Check if request is null
        if($request->all() == null) {
            return $this->sendResponseCode(400, 'RA_ERROR_NULL: (ServerController) Server Data is Null!');
        }

        // Grab the Server via the api Key
        $server = Server::where('api_key', $request->api_key)->first();
        if(!$server) {
            return $this->sendResponseCode(400, 'Server API Key Invalid. Check your API key and try again.');
        }

        $server->name = $request->name;
        $server->ip_address = $request->ip_address;
        $server->port = $request->port;
        $server->protocol = $request->protocol;
        $server->world_seed = $request->world_seed;
        $server->world_name = $request->world_name;
        $server->map_size = $request->map_size;
        $server->last_wiped = DateTime::createFromFormat('m/d/Y H:i:s', $request->last_wiped)->format('Y-m-d H:i:s');
        $server->blueprint_last_wiped = DateTime::createFromFormat('m/d/Y H:i:s', $request->blueprint_last_wiped)->format('Y-m-d H:i:s');
        $server->description = $request->description;
        $server->version = $request->version;
        $server->save();

        print($server);
    }
}
