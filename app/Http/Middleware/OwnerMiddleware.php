<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OwnerMiddleware
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
        $mod = $request->route('mod');

        if($mod==null) {
            return response()->json(['message'=>'The mod cannot be found'], 404);
        }

        if($mod->user_id != auth()->user()->id) {
            return response()->json(['message'=>'You are not the owner of this mod.'], 401);
        }

        return $next($request);
    }
}
