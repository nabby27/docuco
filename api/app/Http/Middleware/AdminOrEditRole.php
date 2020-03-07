<?php

namespace Docuco\Http\Middleware;

use Closure;
use Docuco\Domain\Users\Actions\CheckUserCanEditAction;
use Docuco\Infrastructure\Services\GetRoleFromRequestService;

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
        $get_role_from_request_service = new GetRoleFromRequestService();
        $role = $get_role_from_request_service->execute($request);

        $check_user_can_edit_action = new CheckUserCanEditAction();
        if (false === $check_user_can_edit_action->execute($role)) {
            return response(['message' => 'Not have permissions.'], 423);
        };

        return $next($request);
    }
}
