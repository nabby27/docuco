<?php

namespace Tests\Unit\Documents\Actions;

use Tests\TestCase;
use Docuco\Domain\Users\Actions\CheckUserCanEditAction;
use Docuco\Domain\Users\Actions\CheckUserIsAdminAction;
use Docuco\Domain\Users\Constants\RoleConstants;
use Docuco\Domain\Users\Entities\User;
use Docuco\Domain\Users\ValueObjects\RoleVO;
use Docuco\Domain\Users\Entities\UserGroup;

class CheckUserRoleUnitTest extends TestCase
{

    public function test_return_true_if_user_can_edit()
    {
        [$user, $user_group, $role] = $this->create_edit_user();
        $check_user_can_edit_action = new CheckUserCanEditAction();

        $response = $check_user_can_edit_action->execute($role);

        $this->assertEquals(true, $response);
    }

    public function test_return_false_if_user_can_edit()
    {
        [$user, $user_group, $role] = $this->create_user();
        $check_user_can_edit_action = new CheckUserCanEditAction();

        $response = $check_user_can_edit_action->execute($role);

        $this->assertEquals(false, $response);
    }

    public function test_return_false_if_user_not_admin()
    {
        [$user, $user_group, $role] = $this->create_user();
        $check_user_is_admin_action = new CheckUserIsAdminAction();

        $response = $check_user_is_admin_action->execute($role);

        $this->assertEquals(false, $response);
    }

    private function create_user()
    {
        $user_group = new UserGroup(1, 'example');
        $role = new RoleVO(RoleConstants::VIEW);

        $user = new User(
            1,
            'nabby27',
            'icordobadonet@gmail.com',
            $user_group->name,
            $role->name
        );

        return [$user, $user_group, $role];
    }

    private function create_edit_user()
    {
        $user_group = new UserGroup(1, 'example');
        $role = new RoleVO(RoleConstants::EDIT);

        $user = new User(
            1,
            'nabby27',
            'icordobadonet@gmail.com',
            $user_group->name,
            $role->name
        );

        return [$user, $user_group, $role];
    }
}
