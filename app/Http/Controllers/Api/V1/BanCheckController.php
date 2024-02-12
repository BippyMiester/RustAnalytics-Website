<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BanCheckController extends Controller
{
    public function username(Request $request) {
        // Check if request is null
        if($request->all() == null) {
            return $this->sendResponseCode(400, 'RA_ERROR_NULL: (BanCheckController) BanCheckController Data is Null!');
        }

        // Grab the Server via the api Key
        $server = Server::where('api_key', $request->api_key)->first();
        if(!$server) {
            return $this->sendResponseCode(400, 'Server API Key Invalid. Check your API key and try again.');
        }

        $servers = Server::where('user_id', $server->user_id)->get();
        foreach($servers as $server) {
            //error_log($server->name);
            $bans = $server->bans()->get();
            foreach($bans as $ban) {
                //error_log($ban->username);
                if($ban->username == $request->username) {
                    return "true";
                }
            }
        }

        return "false";
    }

    public function steamid(Request $request) {
        // Check if request is null
        if($request->all() == null) {
            return $this->sendResponseCode(400, 'RA_ERROR_NULL: (AnimalKillsController) Animal Kills Data is Null!');
        }

        // Grab the Server via the api Key
        $server = Server::where('api_key', $request->api_key)->first();
        if(!$server) {
            return $this->sendResponseCode(400, 'Server API Key Invalid. Check your API key and try again.');
        }

        $servers = Server::where('user_id', $server->user_id)->get();
        foreach($servers as $server) {
            //error_log($server->name);
            $bans = $server->bans()->get();
            foreach($bans as $ban) {
                //error_log($ban->steam_id);
                if($ban->steam_id == $request->steamid) {
                    return "true";
                }
            }
        }

        return "false";
    }

    public function ipaddress(Request $request) {
        // Check if request is null
        if($request->all() == null) {
            return $this->sendResponseCode(400, 'RA_ERROR_NULL: (AnimalKillsController) Animal Kills Data is Null!');
        }

        // Grab the Server via the api Key
        $server = Server::where('api_key', $request->api_key)->first();
        if(!$server) {
            return $this->sendResponseCode(400, 'Server API Key Invalid. Check your API key and try again.');
        }

        //error_log('Your debug message');
        //error_log($request->ipaddress);

        $servers = Server::where('user_id', $server->user_id)->get();
        foreach($servers as $server) {
            //error_log($server->name);
            $bans = $server->bans()->get();
            foreach($bans as $ban) {
                //error_log($ban->ip_address);
                if($ban->ip_address == $request->ipaddress) {
                    return "true";
                }
            }
        }

        return "false";
    }
}
