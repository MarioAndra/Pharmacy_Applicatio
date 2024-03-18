<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class owner
{

    public function handle(Request $request, Closure $next): Response
    {

        $user=Auth::user();
        if($user->role_id=='1'){
            return $next($request);
        }
        return response()->json(['Unauthorized'],403);
    }

  }

