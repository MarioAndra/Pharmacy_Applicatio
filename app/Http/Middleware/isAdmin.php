<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{

    public function handle(Request $request, Closure $next): Response
    {
        $user =Auth::user();
        return $user;
        if ($user->isAdmin='admin') {
            return $next($request);
        }
        return response()->json(['Unauthorised'],401);

    }

  }

