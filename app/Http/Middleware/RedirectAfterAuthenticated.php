<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectAfterAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $user = User::factory()->create();

        Auth::login($user);

//        if ($request->wantsJson()){
//            $request->headers->set('X-Authorization', 'xxxxx');
//        }

        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}
