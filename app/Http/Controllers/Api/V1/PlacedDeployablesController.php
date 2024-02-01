<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\PlacedDeployables;
use App\Models\Server;
use Illuminate\Http\Request;

class PlacedDeployablesController extends Controller
{
    private function sendResponseCode(int $code, string $msg) {
        return response()->json(['Response Message' => $msg], $code);
    }

    public function create(Request $request) {
        // Check if request is null
        if($request->all() == null) {
            return $this->sendResponseCode(400, 'RA_ERROR_NULL: (PlacedDeployablesController) Placed Deployables Data is Null!');
        }

        // Grab the Server via the api Key
        $server = Server::where('api_key', $request->api_key)->first();
        if(!$server) {
            return $this->sendResponseCode(400, 'Server API Key Invalid. Check your API key and try again.');
        }

        $placedDeployable = new PlacedDeployables;
        $placedDeployable->server_id = $server->id;
        $placedDeployable->username = $request->username;
        $placedDeployable->steam_id = $request->steam_id;
        $placedDeployable->type = $request->type;
        $placedDeployable->amount = $request->amount;
        $placedDeployable->x = $request->x;
        $placedDeployable->y = $request->y;
        $placedDeployable->z = $request->z;
        $placedDeployable->grid = $request->grid;
        $placedDeployable->save();

        print($placedDeployable);
    }
}
