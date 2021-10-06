<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class Administrator
{
    use HasRoles;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $all_roles_except_tab = Role::whereNotIn('name', ['god', 'admin'])->get();
        if (count(Auth::user()->roles)) {
            $userRole = Auth::user()->roles[0]['name'];

            foreach ($all_roles_except_tab as $role) {

                if ($userRole != $role->name) {

                    return $next($request);
                }
                abort(403, 'vous n\'etes pas administrateur');
            }
        }
        abort(403, 'vous n\'etes pas administrateur');
    }
}
