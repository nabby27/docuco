<?php

namespace Docuco\Infrastructure\Services;

use Illuminate\Http\Request;

class GetUsersGroupIdFromRequestService
{
    public function execute(Request $request): int
    {
        return $request->user()->users_group_id;
    }
}
