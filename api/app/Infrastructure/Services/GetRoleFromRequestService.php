<?php

namespace Docuco\Infrastructure\Services;

use Docuco\Domain\Users\ValueObjects\RoleVO;
use Illuminate\Http\Request;

class GetRoleFromRequestService
{
    public function execute(Request $request): RoleVO
    {
        $request_role = $request->user()->role;

        return new RoleVO($request_role->name);
    }
}
