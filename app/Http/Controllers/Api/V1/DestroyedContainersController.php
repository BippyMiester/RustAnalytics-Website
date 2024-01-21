<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\DestroyedContainers;
use App\Models\Server;
use Illuminate\Http\Request;

class DestroyedContainersController extends Controller
{
    private function sendResponseCode(int $code, string $msg) {
        return response()->json(['Response Message' => $msg], $code);
    }

    public function create(Request $request) {
        // Check if request is null
        if($request->all() == null) {
            return $this->sendResponseCode(400, 'RA_ERROR_NULL: (DestroyedContainersController) Destroyed Containers Data is Null!');
        }

        // Grab the Server via the api Key
        $server = Server::where('api_key', $request->api_key)->first();
        if(!$server) {
            return $this->sendResponseCode(400, 'Server API Key Invalid. Check your API key and try again.');
        }

        $destroyedContainer = new DestroyedContainers;
        $destroyedContainer->server_id = $server->id;
        $destroyedContainer->username = $request->username;
        $destroyedContainer->steam_id = $request->steam_id;
        $destroyedContainer->owner = $request->owner;
        $destroyedContainer->type = $request->type;
        $destroyedContainer->weapon = $request->weapon;
        $destroyedContainer->grid = $request->grid;
        $destroyedContainer->x = $request->x;
        $destroyedContainer->y = $request->y;
        $destroyedContainer->z = $request->z;
        $destroyedContainer->save();

        print($destroyedContainer);
    }
}
