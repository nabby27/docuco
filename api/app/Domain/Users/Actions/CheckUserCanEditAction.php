<?php

namespace Docuco\Domain\Users\Actions;

use Docuco\Domain\Users\Constants\RoleConstants;
use Docuco\Domain\Users\ValueObjects\RoleVO;

class CheckUserCanEditAction
{

    public function execute(RoleVO $role): bool
    {
        $check_user_is_admin = new CheckUserIsAdminAction();
        $is_admin = $check_user_is_admin->execute($role);

        return $is_admin || RoleConstants::EDIT === $role->name;
    }
}
