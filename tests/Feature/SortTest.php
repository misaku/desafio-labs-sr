<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class SortTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
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
        $token = json_decode($response->content(), true)['token'];
        $response = $this->json('POST', '/api/sort', ['list' => [100, 2, 3, 5, 7, 11, 13, -3, -1, 0, 1, 4, 33, 22, 6, 8, 9, 10, 12]], [...$headers, 'Authorization' => 'Bearer '.$token]);
        $response->assertStatus(Response::HTTP_OK);
    }
}
