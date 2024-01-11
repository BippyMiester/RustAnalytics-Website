<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\PlacedStructures;
use App\Models\Server;
use Illuminate\Http\Request;

class PlacedStructuresController extends Controller
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

        $placedStructure = new PlacedStructures;
        $placedStructure->server_id = $server->id;
        $placedStructure->username = $request->username;
        $placedStructure->steam_id = $request->steam_id;
        $placedStructure->type = $request->type;
        $placedStructure->amount = $request->amount;
        $placedStructure->save();

        print($placedStructure);
    }
}
