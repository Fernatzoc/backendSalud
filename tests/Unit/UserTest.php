<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;

use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_login_user()
    {
        $formData = [
            "email" => "admin@example.com",
            "password" => "Test@123",
        ];

        $this->json('POST', route('loginApi'), $formData)
            ->assertStatus(200);
    }

    // public function test_can_create_user()
    // {
    //     $token = JWTAuth::parseToken()->authenticate();
    //     $this->withHeader('Authorization', "Bearer {$token}");

    //     $formData = [
    //         "name" => "Esteban Salinas",
    //         "email" => "estebam15@example.com",
    //         "password" => "123456789",
    //         "role" => "Personal"
    //     ];

    //     $this->json('POST', route('newUserApi'), $formData)
    //         ->assertStatus(201);
    // }
}
