<?php

namespace Tests\Unit\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Requests\PlacesGetRequest;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_that_login_is_not_ok(): void
    {
        $controller = new AuthController();
        $request = PlacesGetRequest::create('/api/auth', 'POST', ['email' => 'admin@luizalabs.com', 'password' => '#luizaLabs1237', 'device_name' => 'device-123']);
        $this->expectException(ValidationException::class);
        $controller->login($request);
    }

    public function test_that_login_is_ok(): void
    {
        $controller = new AuthController();
        $request = PlacesGetRequest::create('/api/auth', 'POST', ['email' => 'admin@luizalabs.com', 'password' => '#luizaLabs123', 'device_name' => 'device-123']);

        $auth = $controller->login($request);
        $content = json_decode($auth->content(), true);
        $this->assertTrue(! empty($content['token']));
    }
}
