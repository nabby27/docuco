<?php

namespace Docuco\Http\Middleware;

use Closure;
use Docuco\Domain\Users\Actions\CheckUserHaveAdminOrEditRoleAction;

class AdminOrEditRole
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
        $check_user_have_admin_or_edit_role_action = new CheckUserHaveAdminOrEditRoleAction();
        if (false === $check_user_have_admin_or_edit_role_action->execute($role)) {
            return response(['message' => 'Not have permissions.'], 423);
        };

        return $next($request);
    }
}
