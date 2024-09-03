<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLaunchDate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Define the launch date
        $launchDate = \Carbon\Carbon::create(2024, 8, 28, 0, 0, 0, 'Asia/Jakarta'); // Example: September 15, 2024

        if (now()->lt($launchDate)) {
            // return redirect('/');
            return redirect()->route('waiting');
        }

        return $next($request);
    }
}
