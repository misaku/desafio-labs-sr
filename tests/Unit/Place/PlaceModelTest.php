<?php

namespace Tests\Unit\Place;

use App\Models\Place;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlaceModelTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;
    protected function transformerPlace($list)
    {
        $response = [];
        foreach ($list as $value) {
            $baseRow = [];
            $baseRow['name'] = $value->name;
            if (isset($value->status)) {
                $baseRow['status'] = $value->status;
            }
            if (isset($value->distance)) {
                $baseRow['distance'] = number_format($value->distance, 2, ',', '').'m';
            }
            if (! is_null($value->opened) && ! is_null($value->closed)) {
                $baseRow['opened'] = $value->opened;
                $baseRow['closed'] = $value->closed;
            }
            $response[] = $baseRow;
        }

        return $response;
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_that_get_all_is_valid(): void
    {
        $places = $this->transformerPlace(Place::findAll('19:00', 20, 10, 10));
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
        $places = $this->transformerPlace(Place::findAll(null, null, null, null));
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
        $places = $this->transformerPlace(Place::findAll('19:00', null, null, null));
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
        $places = $this->transformerPlace(Place::findAll(null, 20, 10, null));
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
        $places = $this->transformerPlace(Place::findAll('19:00', 20, 10, null));
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

    public function test_that_get_whiout_hr_model_is_valid(): void
    {
        $places = $this->transformerPlace(Place::findAll(null, 20, 10, 10));
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
}
