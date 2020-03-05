<?php

namespace Tests\E2E;

use Tests\TestCase;

class WelcomeE2ETest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testWelcomeToDocucoApi()
    {
        $response = $this->json('GET', '/api/');

        $response
            ->assertStatus(200)
            ->assertExactJson(['message' => 'Wellcome to Docuco API!']);
    }
}
