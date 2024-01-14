<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // User Dashboard
    public function dashboard() {
        $user = Auth::user();
        $servers = Server::where('user_id', Auth::id())->get();

//        dd($servers);
        // return view('pages.404');
        return view('user.dashboard')
            ->withUser($user)
            ->withServers($servers);
    }
}
