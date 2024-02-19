<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminDashboardController extends Controller
{

    public function index(Request $request) {

    }

    public function forcelogin(Request $request) {
        $users = User::paginate(15);

        return view('admin.forcelogin')
            ->withUsers($users);
    }

    public function forceloginpost(Request $request) {
        $user = User::where('id', $request->user_id)->first();
        Auth::logout();
        Session::flush();
        Auth::login($user, false);
        return redirect()->route('user.dashboard.index');
    }

    public function servers() {
        $servers = Server::orderByDesc('created_at')->paginate(15);
        $serversCount = Server::all()->count();

        return view('admin.servers')
            ->withAdminServers($servers)
            ->withServersCount($serversCount);
    }
}
