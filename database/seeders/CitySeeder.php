<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\Province;

class CitySeeder extends Seeder
{
    public function run()
    {
        $provinces = Province::all();

        $cities = [
            'Barcelona' => [
                ['name' => 'Barcelona (Ciudad)', 'slug' => 'barcelona-ciudad'],
                ['name' => 'Badalona', 'slug' => 'badalona'],
                ['name' => 'L\'Hospitalet de Llobregat', 'slug' => 'l-hospitalet-de-llobregat'],
                ['name' => 'Terrassa', 'slug' => 'terrassa'],
                ['name' => 'Sabadell', 'slug' => 'sabadell'],
                // Add more cities for Barcelona...
            ],
            'Madrid' => [
                ['name' => 'Madrid (Ciudad)', 'slug' => 'madrid-ciudad'],
                ['name' => 'Móstoles', 'slug' => 'mostoles'],
                ['name' => 'Alcalá de Henares', 'slug' => 'alcala-de-henares'],
                ['name' => 'Fuenlabrada', 'slug' => 'fuenlabrada'],
                ['name' => 'Leganés', 'slug' => 'leganes'],
                // Add more cities for Madrid...
            ],
            'Valencia' => [
                ['name' => 'Valencia (Ciudad)', 'slug' => 'valencia-ciudad'],
                ['name' => 'Torrent', 'slug' => 'torrent'],
                ['name' => 'Gandia', 'slug' => 'gandia'],
                ['name' => 'Paterna', 'slug' => 'paterna'],
                ['name' => 'Sagunto', 'slug' => 'sagunto'],
                // Add more cities for Valencia...
            ],
            'Sevilla' => [
                ['name' => 'Sevilla (Ciudad)', 'slug' => 'sevilla-ciudad'],
                ['name' => 'Dos Hermanas', 'slug' => 'dos-hermanas'],
                ['name' => 'Alcalá de Guadaíra', 'slug' => 'alcala-de-guadaira'],
                ['name' => 'Utrera', 'slug' => 'utrera'],
                ['name' => 'Écija', 'slug' => 'ecija'],
                // Add more cities for Sevilla...
            ],
            'Zaragoza' => [
                ['name' => 'Zaragoza (Ciudad)', 'slug' => 'zaragoza-ciudad'],
                ['name' => 'Calatayud', 'slug' => 'calatayud'],
                ['name' => 'Utebo', 'slug' => 'utebo'],
                ['name' => 'Ejea de los Caballeros', 'slug' => 'ejea-de-los-caballeros'],
                ['name' => 'Tarazona', 'slug' => 'tarazona'],
                // Add more cities for Zaragoza...
            ],
            'Málaga' => [
                ['name' => 'Málaga (Ciudad)', 'slug' => 'malaga-ciudad'],
                ['name' => 'Marbella', 'slug' => 'marbella'],
                ['name' => 'Vélez-Málaga', 'slug' => 'velez-malaga'],
                ['name' => 'Fuengirola', 'slug' => 'fuengirola'],
                ['name' => 'Torremolinos', 'slug' => 'torremolinos'],
                // Add more cities for Málaga...
            ],
            'Murcia' => [
                ['name' => 'Murcia (Ciudad)', 'slug' => 'murcia-ciudad'],
                ['name' => 'Cartagena', 'slug' => 'cartagena'],
                ['name' => 'Lorca', 'slug' => 'lorca'],
                ['name' => 'Molina de Segura', 'slug' => 'molina-de-segura'],
                ['name' => 'Alcantarilla', 'slug' => 'alcantarilla'],
                // Add more cities for Murcia...
            ],
            'Las Palmas' => [
                ['name' => 'Las Palmas de Gran Canaria (Ciudad)', 'slug' => 'las-palmas-de-gran-canaria-ciudad'],
                ['name' => 'Telde', 'slug' => 'telde'],
                ['name' => 'Santa Lucía de Tirajana', 'slug' => 'santa-lucia-de-tirajana'],
                ['name' => 'Arucas', 'slug' => 'arucas'],
                ['name' => 'San Bartolomé de Tirajana', 'slug' => 'san-bartolome-de-tirajana'],
                // Add more cities for Las Palmas...
            ],
            'Santa Cruz de Tenerife' => [
                ['name' => 'Santa Cruz de Tenerife (Ciudad)', 'slug' => 'santa-cruz-de-tenerife-ciudad'],
                ['name' => 'San Cristóbal de La Laguna', 'slug' => 'san-cristobal-de-la-laguna'],
                ['name' => 'Arona', 'slug' => 'arona'],
                ['name' => 'Adeje', 'slug' => 'adeje'],
                ['name' => 'La Orotava', 'slug' => 'la-orotava'],
                // Add more cities for Santa Cruz de Tenerife...
            ],
            'Ceuta' => [
                ['name' => 'Ceuta (Ciudad)', 'slug' => 'ceuta-ciudad'],
            ],
            'Melilla' => [
                ['name' => 'Melilla (Ciudad)', 'slug' => 'melilla-ciudad'],
            ],
            // Add cities for other provinces...
        ];

        foreach ($provinces as $province) {
            if (isset($cities[$province->name])) {
                foreach ($cities[$province->name] as $city) {
                    City::create([
                        'name' => $city['name'],
                        'slug' => $city['slug'],
                        'province_id' => $province->id, // Automatically assigned
                    ]);
                }
            }
        }
    }
}