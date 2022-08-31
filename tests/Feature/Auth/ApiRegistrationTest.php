<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_users_can_register_by_api()
    {
        $response = $this->post('/api/user', [
            'name' => 'Test Api User',
            'email' => 'testapi@example.com',
            'password' => 'password1',
            'password_confirmation' => 'password1',
        ]);
        $this->assertAuthenticated();
        $this->assertIsString($response->json());
    }
}
