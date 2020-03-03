<?php

namespace Docuco\Domain\Users\Actions;

use Docuco\Domain\Users\Constants\RoleConstants;

class CheckUserHaveAdminRoleAction
{

    public function execute(string $role): bool
    {
        return RoleConstants::ADMIN === $role;
    }
}
