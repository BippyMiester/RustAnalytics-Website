<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index() {
        return abort(404);
    }

    public function settings() {
        return abort(404);
    }

    public function apikeys() {
        $servers = Auth::user()->servers()->select('api_key', 'slug', 'name')->get();

        return view('user.dashboard.apiKeys')
            ->withServers($servers);
    }
}
