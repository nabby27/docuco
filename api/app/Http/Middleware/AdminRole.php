<?php

namespace Docuco\Http\Middleware;

use Closure;
use Docuco\Domain\Users\Actions\CheckUserIsAdminAction;
use Docuco\Infrastructure\Services\GetRoleFromRequestService;

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
        $get_role_from_request_service = new GetRoleFromRequestService();
        $role = $get_role_from_request_service->execute($request);

        $check_user_is_admin_action = new CheckUserIsAdminAction();
        if (false === $check_user_is_admin_action->execute($role)) {
            return response(['message' => 'Not have permissions.'], 423);
        };

        return $next($request);
    }
}
