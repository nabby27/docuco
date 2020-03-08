<?php

namespace Tests\E2E;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GetAllUserE2ETest extends TestCase
{
    use DatabaseTransactions;

    private $endpoint = '/api/users';

    public function test_return_error_message_when_user_not_logged()
    {
        assert_unauthenticated($this, $this->endpoint);
    }

    public function test_return_only_users_for_group_when_user_logged()
    {
        $user_group_1 = create_user_group('first user group');
        create_user($user_group_1);

        $user_group_2 = create_user_group('second user group');
        create_user($user_group_2);
        create_user($user_group_2);
        [$user, $token, $password] = get_user_and_token_after_login($this, $user_group_2);

        $response = $this->make_get_petition($token);

        $response
            ->assertStatus(200)
            ->assertJsonCount(3, 'users');
    }

    private function make_get_petition($token = '')
    {
        return $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->json('GET', $this->endpoint);
    }
}
