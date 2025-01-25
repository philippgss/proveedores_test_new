<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;
use App\Models\Region;

class ProvinceSeeder extends Seeder
{
    public function run()
    {
        $regions = Region::all();

        $provinces = [
            'Andalucía' => [
                ['name' => 'Almería', 'slug' => 'almeria'],
                ['name' => 'Cádiz', 'slug' => 'cadiz'],
                ['name' => 'Córdoba', 'slug' => 'cordoba'],
                ['name' => 'Granada', 'slug' => 'granada'],
                ['name' => 'Huelva', 'slug' => 'huelva'],
                ['name' => 'Jaén', 'slug' => 'jaen'],
                ['name' => 'Málaga', 'slug' => 'malaga'],
                ['name' => 'Sevilla', 'slug' => 'sevilla'],
            ],
            'Aragón' => [
                ['name' => 'Huesca', 'slug' => 'huesca'],
                ['name' => 'Teruel', 'slug' => 'teruel'],
                ['name' => 'Zaragoza', 'slug' => 'zaragoza'],
            ],
            'Principado de Asturias' => [
                ['name' => 'Asturias', 'slug' => 'asturias'],
            ],
            'Islas Baleares (Comunidad)' => [
                ['name' => 'Islas Baleares', 'slug' => 'islas-baleares'],
            ],
            'Canarias' => [
                ['name' => 'Las Palmas', 'slug' => 'las-palmas'],
                ['name' => 'Santa Cruz de Tenerife', 'slug' => 'santa-cruz-de-tenerife'],
            ],
            'Cantabria' => [
                ['name' => 'Cantabria', 'slug' => 'cantabria'],
            ],
            'Castilla-La Mancha' => [
                ['name' => 'Albacete', 'slug' => 'albacete'],
                ['name' => 'Ciudad Real', 'slug' => 'ciudad-real'],
                ['name' => 'Cuenca', 'slug' => 'cuenca'],
                ['name' => 'Guadalajara', 'slug' => 'guadalajara'],
                ['name' => 'Toledo', 'slug' => 'toledo'],
            ],
            'Castilla y León' => [
                ['name' => 'Ávila', 'slug' => 'avila'],
                ['name' => 'Burgos', 'slug' => 'burgos'],
                ['name' => 'León', 'slug' => 'leon'],
                ['name' => 'Palencia', 'slug' => 'palencia'],
                ['name' => 'Salamanca', 'slug' => 'salamanca'],
                ['name' => 'Segovia', 'slug' => 'segovia'],
                ['name' => 'Soria', 'slug' => 'soria'],
                ['name' => 'Valladolid', 'slug' => 'valladolid'],
                ['name' => 'Zamora', 'slug' => 'zamora'],
            ],
            'Catalunya' => [
                ['name' => 'Barcelona', 'slug' => 'barcelona'],
                ['name' => 'Girona', 'slug' => 'girona'],
                ['name' => 'Lleida', 'slug' => 'lleida'],
                ['name' => 'Tarragona', 'slug' => 'tarragona'],
            ],
            'Comunidad Valenciana' => [
                ['name' => 'Alicante', 'slug' => 'alicante'],
                ['name' => 'Castellón', 'slug' => 'castellon'],
                ['name' => 'Valencia', 'slug' => 'valencia'],
            ],
            'Extremadura' => [
                ['name' => 'Badajoz', 'slug' => 'badajoz'],
                ['name' => 'Cáceres', 'slug' => 'caceres'],
            ],
            'Galicia' => [
                ['name' => 'A Coruña', 'slug' => 'a-coruna'],
                ['name' => 'Lugo', 'slug' => 'lugo'],
                ['name' => 'Ourense', 'slug' => 'ourense'],
                ['name' => 'Pontevedra', 'slug' => 'pontevedra'],
            ],
            'La Rioja' => [
                ['name' => 'La Rioja', 'slug' => 'la-rioja'],
            ],
            'Comunidad de Madrid' => [
                ['name' => 'Madrid', 'slug' => 'madrid'],
            ],
            'Región de Murcia' => [
                ['name' => 'Murcia', 'slug' => 'murcia'],
            ],
            'Comunidad Foral de Navarra' => [
                ['name' => 'Navarra', 'slug' => 'navarra'],
            ],
            'País Vasco' => [
                ['name' => 'Álava', 'slug' => 'alava'],
                ['name' => 'Guipúzcoa', 'slug' => 'guipuzcoa'],
                ['name' => 'Vizcaya', 'slug' => 'vizcaya'],
            ],
            'Ciudades Autónomas' => [
                ['name' => 'Ceuta', 'slug' => 'ceuta'],
                ['name' => 'Melilla', 'slug' => 'melilla'],
            ],
        ];

        foreach ($regions as $region) {
            if (isset($provinces[$region->name])) {
                foreach ($provinces[$region->name] as $province) {
                    Province::create([
                        'name' => $province['name'],
                        'slug' => $province['slug'],
                        'region_id' => $region->id, // Automatically assigned
                    ]);
                }
            }
        }
    }
}