<?php

namespace Docuco\Infrastructure\Services;

use Illuminate\Http\Request;

class GetUserGroupIdFromRequestService
{
    public function execute(Request $request): int
    {
        return $request->user()->user_group_id;
    }
}
