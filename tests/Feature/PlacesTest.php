<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class PlacesTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_the_application_returns_success_response_with_all_data(): void
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
        $response = $this->json('POST', '/api/places', ['x' => 20, 'y' => 10, 'name' => 'teste 1', 'closed' => '19:00', 'opened' => '15:00'], [...$headers, 'Authorization' => 'Bearer '.$token]);
        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function test_the_application_returns_success_response_with_partial_data(): void
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
        $response = $this->json('POST', '/api/places', ['x' => 20, 'y' => 10, 'name' => 'teste 2'], [...$headers, 'Authorization' => 'Bearer '.$token]);
        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function test_the_application_returns_success_response_get_data(): void
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
        $response = $this->json('GET', '/api/places', ['x' => 20, 'y' => 10, 'mts' => 10, 'hr' => '19:00'], [...$headers, 'Authorization' => 'Bearer '.$token]);
        $response->assertStatus(Response::HTTP_OK);
    }
}
