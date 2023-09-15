<?php

namespace Tests\Unit\Place;

use App\Http\Controllers\PlacesController;
use App\Http\Requests\PlacesGetRequest;
use App\Http\Requests\PlacesPostRequest;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlaceControllerTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    protected function transformerPlace($list)
    {
        $response = [];
        foreach ($list as $value) {
            $baseRow = [];
            foreach ($value as $key => $value2) {
                if ($key != 'id') {
                    $baseRow[$key] = $value2;
                }
            }
            $response[] = $baseRow;
        }

        return $response;
    }

    public function test_that_get_all_is_valid(): void
    {
        $controller = new PlacesController();
        $request = PlacesGetRequest::create('/api/places', 'GET', ['x' => 20, 'y' => 10, 'mts' => 10, 'hr' => '19:00']);
        $places = $this->transformerPlace($controller->index($request));

        $placesBase = [
            [
                'name' => 'Praça',
                'status' => 'aberto',
                'distance' => '5,39m',
            ],
            [
                'name' => 'Restaurante',
                'status' => 'fechado',
                'distance' => '7,28m',
                'opened' => '12:00:00',
                'closed' => '18:00:00',
            ]];
        $this->assertTrue($places == $placesBase);
    }

    public function test_that_get_all_null_is_valid(): void
    {
        $controller = new PlacesController();
        $request = PlacesGetRequest::create('/api/places', 'GET', []);
        $places = $this->transformerPlace($controller->index($request));
        $placesBase = [
            [
                'name' => 'Restaurante',
                'opened' => '12:00:00',
                'closed' => '18:00:00',
            ],
            [
                'name' => 'Posto de combustível',
                'opened' => '08:00:00',
                'closed' => '18:00:00',
            ],
            [
                'name' => 'Praça',
            ],
        ];
        $this->assertTrue($places == $placesBase);
    }

    public function test_that_get_only_hr_is_valid(): void
    {
        $controller = new PlacesController();
        $request = PlacesGetRequest::create('/api/places', 'GET', ['hr' => '19:00']);
        $places = $this->transformerPlace($controller->index($request));
        $placesBase = [
            [
                'name' => 'Praça',
                'status' => 'aberto',
            ],
            [
                'name' => 'Restaurante',
                'status' => 'fechado',
                'opened' => '12:00:00',
                'closed' => '18:00:00',
            ],
            [
                'name' => 'Posto de combustível',
                'status' => 'fechado',
                'opened' => '08:00:00',
                'closed' => '18:00:00',
            ],
        ];
        $this->assertTrue($places == $placesBase);
    }

    public function test_that_get_only_lat_lng_is_valid(): void
    {
        $controller = new PlacesController();
        $request = PlacesGetRequest::create('/api/places', 'GET', ['x' => 20, 'y' => 10]);
        $places = $this->transformerPlace($controller->index($request));
        $placesBase = [
            [
                'name' => 'Praça',
                'distance' => '5,39m',
            ],
            [
                'name' => 'Restaurante',
                'distance' => '7,28m',
                'opened' => '12:00:00',
                'closed' => '18:00:00',
            ],
            [
                'name' => 'Posto de combustível',
                'distance' => '13,60m',
                'opened' => '08:00:00',
                'closed' => '18:00:00',
            ],
        ];
        $this->assertTrue($places == $placesBase);
    }

    public function test_that_get_only_hr_lat_lng_is_valid(): void
    {
        $controller = new PlacesController();
        $request = PlacesGetRequest::create('/api/places', 'GET', ['x' => 20, 'y' => 10, 'hr' => '19:00']);
        $places = $this->transformerPlace($controller->index($request));
        $placesBase = [
            [
                'name' => 'Praça',
                'status' => 'aberto',
                'distance' => '5,39m',
            ],
            [
                'name' => 'Restaurante',
                'status' => 'fechado',
                'distance' => '7,28m',
                'opened' => '12:00:00',
                'closed' => '18:00:00',
            ],
            [
                'name' => 'Posto de combustível',
                'status' => 'fechado',
                'distance' => '13,60m',
                'opened' => '08:00:00',
                'closed' => '18:00:00',
            ],
        ];
        $this->assertTrue($places == $placesBase);
    }

    public function test_that_get_without_hr_is_valid(): void
    {
        $controller = new PlacesController();
        $request = PlacesGetRequest::create('/api/places', 'GET', ['x' => 20, 'y' => 10, 'mts' => 10]);
        $places = $this->transformerPlace($controller->index($request));
        $placesBase = [
            [
                'name' => 'Praça',
                'distance' => '5,39m',
            ],
            [
                'name' => 'Restaurante',
                'distance' => '7,28m',
                'opened' => '12:00:00',
                'closed' => '18:00:00',
            ],
        ];
        $this->assertTrue($places == $placesBase);
    }

    public function test_that_post_all_is_valid(): void
    {
        $controller = new PlacesController();
        $request = PlacesPostRequest::create('/api/places', 'POST', ['x' => 20, 'y' => 10, 'name' => 'teste 1', 'closed' => '19:00', 'opened' => '15:00']);
        $places = $controller->store($request);

        $this->assertTrue($places->status() == 201);
    }

    public function test_that_post_fulltime_is_valid(): void
    {
        $controller = new PlacesController();
        $request = PlacesPostRequest::create('/api/places', 'POST', ['x' => 20, 'y' => 10, 'name' => 'teste 2']);
        $places = $controller->store($request);

        $this->assertTrue($places->status() == 201);
    }
}
