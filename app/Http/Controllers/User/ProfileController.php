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
        $user = Auth::user();

        return view('user.dashboard.settings')
            ->withUser($user);
    }

    public function settingsPOST(Request $request) {
        $user = Auth::user();

        $this->validate($request, [
           'email' => 'required|email',
           'news_notifications' => 'required|boolean'
        ]);

        $user->email = $request->email;
        $user->news_notifications = $request->news_notifications;
        $user->save();

        toastify()->success('Profile Settings Saved!');

        return back();
    }

    public function apikeys() {
        $servers = Auth::user()->servers()->select('api_key', 'slug', 'name')->get();

        return view('user.dashboard.apiKeys')
            ->withServers($servers);
    }
}
