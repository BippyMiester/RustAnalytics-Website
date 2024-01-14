<?php

namespace App\Providers;

use App\Models\Server;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class UserDashboardViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (auth()->check()) {
                $servers = Server::where('user_id', Auth::id())->get();
                $view->with('servers', $servers);
            }
        });
    }
}
