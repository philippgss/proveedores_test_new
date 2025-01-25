<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;
use App\Models\Country;

class RegionSeeder extends Seeder
{
    public function run()
    {
        $country = Country::where('slug', 'espana')->first();

        $regions = [
            ['name' => 'Andalucía', 'slug' => 'andalucia'],
            ['name' => 'Aragón', 'slug' => 'aragon'],
            ['name' => 'Principado de Asturias', 'slug' => 'principado-de-asturias'],
            ['name' => 'Islas Baleares (Comunidad)', 'slug' => 'islas-baleares-comunidad'],
            ['name' => 'Canarias', 'slug' => 'canarias'],
            ['name' => 'Cantabria', 'slug' => 'cantabria'],
            ['name' => 'Castilla-La Mancha', 'slug' => 'castilla-la-mancha'],
            ['name' => 'Castilla y León', 'slug' => 'castilla-y-leon'],
            ['name' => 'Catalunya', 'slug' => 'catalunya'],
            ['name' => 'Comunidad Valenciana', 'slug' => 'comunidad-valenciana'],
            ['name' => 'Extremadura', 'slug' => 'extremadura'],
            ['name' => 'Galicia', 'slug' => 'galicia'],
            ['name' => 'La Rioja', 'slug' => 'la-rioja'],
            ['name' => 'Comunidad de Madrid', 'slug' => 'comunidad-de-madrid'],
            ['name' => 'Región de Murcia', 'slug' => 'region-de-murcia'],
            ['name' => 'Comunidad Foral de Navarra', 'slug' => 'comunidad-foral-navarra'],
            ['name' => 'País Vasco', 'slug' => 'pais-vasco'],
            ['name' => 'Ciudades Autónomas', 'slug' => 'ciudades-autonomas'], // For Ceuta and Melilla
        ];

        foreach ($regions as $region) {
            Region::create([
                'name' => $region['name'],
                'slug' => $region['slug'],
                'country_id' => $country->id,
            ]);
        }
    }
}