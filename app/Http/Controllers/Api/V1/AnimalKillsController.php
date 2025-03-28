<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\AnimalKills;
use App\Models\DestroyedBuildings;
use App\Models\Server;
use Illuminate\Http\Request;

class AnimalKillsController extends Controller
{
    private function sendResponseCode(int $code, string $msg) {
        return response()->json(['Response Message' => $msg], $code);
    }

    public function create(Request $request) {
        // Check if request is null
        if($request->all() == null) {
            return $this->sendResponseCode(400, 'RA_ERROR_NULL: (AnimalKillsController) Animal Kills Data is Null!');
        }

        // Grab the Server via the api Key
        $server = Server::where('api_key', $request->api_key)->first();
        if(!$server) {
            return $this->sendResponseCode(400, 'Server API Key Invalid. Check your API key and try again.');
        }

        $animalKill = new AnimalKills;
        $animalKill->server_id = $server->id;
        $animalKill->username = $request->username;
        $animalKill->steam_id = $request->steam_id;
        $animalKill->animal_type = $request->animal_type;
        $animalKill->distance = $request->distance;
        $animalKill->weapon = $request->weapon;
        $animalKill->save();

        print($animalKill);
    }
}
