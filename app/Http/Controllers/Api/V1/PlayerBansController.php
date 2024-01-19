<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\PlayerBan;
use App\Models\PlayerData;
use App\Models\Server;
use Illuminate\Http\Request;

class PlayerBansController extends Controller
{
    private function sendResponseCode(int $code, string $msg) {
        return response()->json(['Response Message' => $msg], $code);
    }

    public function create(Request $request) {
        // Check if request is null
        if($request->all() == null) {
            return $this->sendResponseCode(400, 'RA_ERROR_NULL: (PlayerBansController) Player Bans Data is Null!');
        }

        // Grab the Server via the api Key
        $server = Server::where('api_key', $request->api_key)->first();
        if(!$server) {
            return $this->sendResponseCode(400, 'Server API Key Invalid. Check your API key and try again.');
        }

        $playerBanData = new PlayerBan;
        $playerBanData->server_id = $server->id;
        $playerBanData->steam_id = $request->steam_id;
        $playerBanData->username = $request->username;
        $playerBanData->ip_address = $request->ip_address;
        $playerBanData->reason = $request->reason;
        $playerBanData->save();

        print($playerBanData);
    }

    public function destroy(Request $request) {
        // Check if request is null
        if($request->all() == null) {
            return $this->sendResponseCode(400, 'Data is null!');
        }

        // Grab the Server via the api Key
        $server = Server::where('api_key', $request->api_key)->first();
        if(!$server) {
            return $this->sendResponseCode(400, 'Server API Key Invalid. Check your API key and try again.');
        }

        $ban = $server->bans()->where('steam_id', $request->steam_id)->where('server_id', $server->id)->first();
        if(!$ban) {
            return $this->sendResponseCode(400, "The user with the Steam ID ($request->steam_id) is not currently banned.");
        }

        $ban->delete();

        return "The player has been unbanned on RustAnalytics!";
    }
}
