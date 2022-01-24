<?php

namespace App\Http\Middleware;

use Closure;

class AuthorizationKeyIsValid
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
        $x = $request->header('xx_yak_identify_me');

        if (!isset($x) || $x != "$2y$10$/z73ma8anfwxVgvpx5xA5On9tP8qBWLCfI89s28DQAM28AugTi/P.")
        {
            return response()->json([
                'msg' => 'Authorization failed'
            ]);
        }

        return $next($request);
    }
}
