<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class DashboardBansController extends Controller
{
    public function index(Request $request) {
        $user = Auth::user();
        $servers = Server::where('user_id', $user->id)->get();

        $bannedPlayerCount = 0;
        $allBans = collect();

        foreach($servers as $server) {
            $bannedPlayerCount += $server->bans()->count();
            $serverBans = $server->bans()->with('server')->get(); // Get bans for the server
            $allBans = $allBans->merge($serverBans); // Merge current server bans into the allBans collection
        }

        $page = $request->input('page', 25);
        $perPage = 1;
        $offset = ($page - 1) * $perPage;
        $currentPageBans = $allBans->slice($offset, $perPage)->all();
        $totalBans = count($allBans);

        $paginatedBans = new LengthAwarePaginator(
            $currentPageBans,
            $totalBans,
            $perPage,
            $page,
            [
                'path' => $request->url(),
                'query' => array_merge($request->query(), ['page' => $page])
            ]
        );

        return view('user.dashboard.bans.index')
            ->withBannedPlayerCount($bannedPlayerCount)
            ->withPaginatedBans($paginatedBans);
    }
}
