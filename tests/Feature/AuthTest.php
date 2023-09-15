<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;
    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_the_application_returns_unauthorized_response(): void
    {
        $data = [
            'email' => 'admin@luizalabs.com',
            'password' => '#luizaLabs1237',
            'device_name' => 'device-123',
        ];

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];

        $response = $this->json('POST', '/api/auth', $data, $headers);
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function test_the_application_returns_success_response(): void
    {
        $data = [
            'email' => 'admin@luizalabs.com',
            'password' => '#luizaLabs123',
            'device_name' => 'device-123',
        ];

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];

        $response = $this->json('POST', '/api/auth', $data, $headers);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_the_application_returns_get_user_success_response(): void
    {
        $data = [
            'email' => 'admin@luizalabs.com',
            'password' => '#luizaLabs123',
            'device_name' => 'device-123',
        ];

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];

        $response = $this->json('POST', '/api/auth', $data, $headers);
        $token = json_decode($response->content(), true)['token'];
        $response = $this->json('GET', '/api/auth/user', [], [...$headers, 'Authorization' => 'Bearer '.$token]);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_the_application_returns_logout_success_response(): void
    {
        $data = [
            'email' => 'admin@luizalabs.com',
            'password' => '#luizaLabs123',
            'device_name' => 'device-123',
        ];

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];

        $response = $this->json('POST', '/api/auth', $data, $headers);
        $token = json_decode($response->content(), true)['token'];
        $response = $this->json('DELETE', '/api/auth/logout', [], [...$headers, 'Authorization' => 'Bearer '.$token]);
        $response->assertStatus(Response::HTTP_OK);
    }
}
