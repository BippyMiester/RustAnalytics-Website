<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\PlayerGather;
use App\Models\Server;
use Illuminate\Http\Request;

class PlayerGatherController extends Controller
{
    private function sendResponseCode(int $code, string $msg) {
        return response()->json(['Response Message' => $msg], $code);
    }

    public function create(Request $request) {
        // Check if request is null
        if($request->all() == null) {
            return $this->sendResponseCode(400, 'RA_ERROR_NULL: (PlayerGatherController) Player Gather Data is Null!');
        }

        // Grab the Server via the api Key
        $server = Server::where('api_key', $request->api_key)->first();
        if(!$server) {
            return $this->sendResponseCode(400, 'Server API Key Invalid. Check your API key and try again.');
        }

        $playerGather = new PlayerGather;
        $playerGather->server_id = $server->id;
        $playerGather->username = $request->username;
        $playerGather->steam_id = $request->steam_id;
        $playerGather->resource = $request->resource;
        $playerGather->amount = $request->amount;
        $playerGather->save();

        print($playerGather);
    }
}
