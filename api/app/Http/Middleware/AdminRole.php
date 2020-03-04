<?php

namespace Docuco\Http\Middleware;

use Closure;
use Docuco\Domain\Users\Actions\CheckUserHaveAdminRoleAction;

class AdminRole
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
        $role = $request->user()->role->name;
        $check_user_have_admin_role_action = new CheckUserHaveAdminRoleAction();
        if (false === $check_user_have_admin_role_action->execute($role)) {
            return response(['message' => 'Not have permissions.'], 423);
        };

        return $next($request);
    }
}
