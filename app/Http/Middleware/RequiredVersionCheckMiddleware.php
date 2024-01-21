<?php

namespace App\Http\Middleware;

use App\Models\Settings;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequiredVersionCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check the version number to see if it's equal to or higher than the version number in the request.
        $requiredVersion = Settings::where('id', 1)->first()->version;
        //$requiredVersion = "0.0.50"; // Assuming this is your testing value
        $currentVersion = $request->version;

        if (!version_compare($currentVersion, $requiredVersion, '>=')) {
            // Current version is lower than required version
            // Return an error response with a 426 status code
            return response()->json([
                'error' => 'RA_PLUGIN_OUTDATED: Your plugin is outdated. Please update your plugin. Download from here: https://codefling.com/plugins/rustanalytics'
            ], 426);
        }

        return $next($request);
    }
}
