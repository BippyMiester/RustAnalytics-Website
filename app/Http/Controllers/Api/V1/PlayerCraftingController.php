<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\PlayerCrafting;
use App\Models\Server;
use Illuminate\Http\Request;

class PlayerCraftingController extends Controller
{
    private function sendResponseCode(int $code, string $msg) {
        return response()->json(['Response Message' => $msg], $code);
    }

    public function create(Request $request) {
        // Check if request is null
        if($request->all() == null) {
            return $this->sendResponseCode(400, 'RA_ERROR_NULL: (PlayerCraftingController) Player Crafting Data is Null!');
        }

        // Grab the Server via the api Key
        $server = Server::where('api_key', $request->api_key)->first();
        if(!$server) {
            return $this->sendResponseCode(400, 'Server API Key Invalid. Check your API key and try again.');
        }

        $craftedItem = new PlayerCrafting;
        $craftedItem->server_id = $server->id;
        $craftedItem->username = $request->username;
        $craftedItem->steam_id = $request->steam_id;
        $craftedItem->item_crafted = $request->item_crafted;
        $craftedItem->amount = $request->amount;
        $craftedItem->save();

        print($craftedItem);
    }
}
