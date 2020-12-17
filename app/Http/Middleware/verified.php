<?php

namespace App\Http\Middleware;

use Closure;

class verified
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
        if($user->verified == 1){
            return $next($request);
        }
        return redirect()->back()->withStatus(__('you cannot access this page.'));
    }
}
