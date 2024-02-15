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
            $servers = collect(); // Default to an empty collection
            $user = null; // Default to null if not authenticated

            if (auth()->check()) {
                $user = auth()->user(); // Get the authenticated user
                $servers = Server::where('user_id', $user->id)->get(); // Retrieve servers for the authenticated user
            }

            // Share $servers and $user with all views
            $view->with([
                'servers' => $servers,
                'user' => $user
            ]);
        });
    }
}
