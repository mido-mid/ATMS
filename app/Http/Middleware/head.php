<?php

namespace App\Http\Middleware;

use Closure;

class head
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
        $user = auth()->user();
        if($user->type == 1){
            return $next($request);
        }
        return back()->withStatus(__('you cannot access this page.'));
    }
}
