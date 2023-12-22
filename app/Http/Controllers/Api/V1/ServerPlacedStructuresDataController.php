<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Server;
use Illuminate\Http\Request;

class ServerPlacedStructuresDataController extends Controller
{
    public function checkServerAPIToken(Request $request) {
        $server = Server::where('api_key', $request->api_key)->first();
        if(!$server) {
            $this->sendResponseCode(400, 'Server API Key Invalid. Check your API key and try again.');
            return false;
        }
        return true;
    }

    private function sendResponseCode(int $code, string $msg) {
        return response()->json(['message' => $msg], $code);
    }
}
