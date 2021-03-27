<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        $level = Auth::user()->level;
    if($level==='admin'){
        return $next($request);
    }else{
        return redirect(route('forbidden_kingdom'));
    }
    }
}
