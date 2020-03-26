<?php

namespace Docuco\Infrastructure\Services;

use Illuminate\Http\Request;

class GetUserIdFromRequestService
{
    public function execute(Request $request): int
    {
        return $request->user()->id;
    }
}
