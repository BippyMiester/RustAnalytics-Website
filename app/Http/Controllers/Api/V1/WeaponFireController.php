<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Server;
use App\Models\WeaponFire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class WeaponFireController extends Controller
{
    private function sendResponseCode(int $code, string $msg) {
        return response()->json(['Response Message' => $msg], $code);
    }

    public function create(Request $request) {
        // Check if request is null
        if($request->all() == null) {
            return $this->sendResponseCode(400, 'RA_ERROR_NULL: (WeaponFireController) Weapon Fire Data is Null!');
        }

        // Grab the Server via the api Key
        $server = Server::where('api_key', $request->api_key)->first();
        if(!$server) {
            return $this->sendResponseCode(400, 'Server API Key Invalid. Check your API key and try again.');
        }

        $executed = RateLimiter::attempt(
            'serverUpdate:'.$request->api_key,
            $perMinute = 3000,
            function() {}
        );

        if (! $executed) {
            return $this->sendResponseCode(429, 'Rate limit exceeded');
        }

        $weaponFire = new WeaponFire;
        $weaponFire->server_id = $server->id;
        $weaponFire->username = $request->username;
        $weaponFire->steam_id = $request->steam_id;
        $weaponFire->bullet = $request->bullet;
        $weaponFire->weapon = $request->weapon;
        $weaponFire->amount = $request->amount;
        $weaponFire->save();

        print($weaponFire);
    }
}
