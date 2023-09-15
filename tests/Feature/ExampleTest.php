<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_the_application_api_healthcheck_returns_a_successful_response(): void
    {
        $response = $this->get('/api/health');

        $response->assertStatus(200);
    }
    public function test_the_application_web_healthcheck__returns_a_successful_response(): void
    {
        $response = $this->get('/health');

        $response->assertStatus(200);
    }
    public function test_the_application_web_docs__returns_a_successful_response(): void
    {
        $response = $this->get('api/documentation');

        $response->assertStatus(200);
    }
}
