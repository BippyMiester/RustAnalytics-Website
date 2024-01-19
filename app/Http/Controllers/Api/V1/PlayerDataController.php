<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\PlayerData;
use App\Models\Server;
use Illuminate\Http\Request;

class PlayerDataController extends Controller
{
    private function sendResponseCode(int $code, string $msg) {
        return response()->json(['Response Message' => $msg], $code);
    }

    public function create(Request $request) {
        // Check if request is null
        if($request->all() == null) {
            return $this->sendResponseCode(400, 'RA_ERROR_NULL: (PlayerDataController) Player Data is Null!');
        }

        // Grab the Server via the api Key
        $server = Server::where('api_key', $request->api_key)->first();
        if(!$server) {
            return $this->sendResponseCode(400, 'Server API Key Invalid. Check your API key and try again.');
        }

        $playerData = new PlayerData;
        $playerData->server_id = $server->id;
        $playerData->steam_id = $request->steam_id;
        $playerData->frame_rate = $request->frame_rate;
        $playerData->ping = $request->ping;
        $playerData->save();

        print($playerData);
    }

}
