<?php

namespace Docuco\Domain\Users\Actions;

use Docuco\Domain\Users\Constants\RoleConstants;
use Docuco\Domain\Users\ValueObjects\RoleVO;

class CheckUserIsAdminAction
{

    public function execute(RoleVO $role): bool
    {
        return RoleConstants::ADMIN === $role->name;
    }
}
