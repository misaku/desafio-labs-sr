<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PlaceSeeder extends Seeder
{
    public function run(): void
    {

        \App\Models\Place::factory()->create([
            'name' => 'Restaurante',
            'opened' => '12:00',
            'closed' => '18:00',
            'fullTime' => false,
            'lat' => 27,
            'lng' => 12,
        ]);

        \App\Models\Place::factory()->create([
            'name' => 'Posto de combustível',
            'opened' => '08:00',
            'closed' => '18:00',
            'fullTime' => false,
            'lat' => 31,
            'lng' => 18,
        ]);

        \App\Models\Place::factory()->create([
            'name' => 'Praça',
            'fullTime' => true,
            'opened' => null,
            'closed' => null,
            'lat' => 15,
            'lng' => 12,
        ]);
    }
}
