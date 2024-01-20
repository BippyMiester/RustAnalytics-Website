<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class RateLimitingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $apiKey = $request->api_key;
        $rateLimitKey = 'rate_limit:' . $apiKey;

        // Specify the maximum attempts and decay time in seconds
        $maxAttempts = 3;
        $decaySeconds = 60;

        if (RateLimiter::tooManyAttempts($rateLimitKey, $maxAttempts)) {
            $retryAfter = RateLimiter::availableIn($rateLimitKey);

            return response()->json([
                'message' => 'Too many requests, please slow down.',
                'retry_after' => $retryAfter
            ], Response::HTTP_TOO_MANY_REQUESTS);
        }

        // Only hit the rate limiter if the request is successful
        RateLimiter::hit($rateLimitKey, $decaySeconds);

        return $next($request);
    }
}
