<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\DestroyedBuildings;
use App\Models\DestroyedContainers;
use App\Models\Server;
use Illuminate\Http\Request;

class DestroyedBuildingsController extends Controller
{
    private function sendResponseCode(int $code, string $msg) {
        return response()->json(['Response Message' => $msg], $code);
    }

    public function create(Request $request) {
        // Check if request is null
        if($request->all() == null) {
            return $this->sendResponseCode(400, 'RA_ERROR_NULL: (DestroyedBuildingsController) Destroyed Buildings Data is Null!');
        }

        // Grab the Server via the api Key
        $server = Server::where('api_key', $request->api_key)->first();
        if(!$server) {
            return $this->sendResponseCode(400, 'Server API Key Invalid. Check your API key and try again.');
        }

        $destroyedBuilding = new DestroyedBuildings;
        $destroyedBuilding->server_id = $server->id;
        $destroyedBuilding->username = $request->username;
        $destroyedBuilding->steam_id = $request->steam_id;
        $destroyedBuilding->owner = $request->owner;
        $destroyedBuilding->type = $request->type;
        $destroyedBuilding->tier = $request->tier;
        $destroyedBuilding->weapon = $request->weapon;
        $destroyedBuilding->x = $request->x;
        $destroyedBuilding->y = $request->y;
        $destroyedBuilding->z = $request->z;
        $destroyedBuilding->grid = $request->grid;
        $destroyedBuilding->save();

        print($destroyedBuilding);
    }
}
