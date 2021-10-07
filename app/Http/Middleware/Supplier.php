<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Supplier
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
        if (count(Auth::user()->roles)) {
            $userRole = Auth::user()->roles[0]['name'];
             $userRole === 'supply' ? $next($request) : abort(403, 'vous n\'etes pas dans l\'équipe des chargés de fournisseurs');
            }
        abort(403, 'vous n\'etes pas administrateur');
    }
}
