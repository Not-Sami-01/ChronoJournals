<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class DestroySessionOnReload
{
/**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // // Skip if request is an AJAX request (including Livewire requests)
        // if ($request->ajax() || $request->wantsJson()) {
        //     return $next($request);
        // }

        // // Track the request if it's a full page reload
        // $sessionStatus = $request->session()->get('session_destroyed_on_reload', false);

        // if ($sessionStatus) {
        //     // Clear the session
        //     Session::flush();
        //     // Remove the flag
        //     $request->session()->forget('session_destroyed_on_reload');
        //     // Redirect to the login page
        //     return redirect()->route('login');
        // }

        // // Set a flag indicating a full page reload
        // $request->session()->put('session_destroyed_on_reload', true);

        return $next($request);
    }
}

