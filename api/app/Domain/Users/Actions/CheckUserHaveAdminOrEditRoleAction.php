<?php

namespace Docuco\Domain\Users\Actions;

use Docuco\Domain\Users\Constants\RoleConstants;

class CheckUserHaveAdminOrEditRoleAction
{

    public function execute(string $role): bool
    {
        return RoleConstants::ADMIN === $role || RoleConstants::EDIT === $role;
    }
}
