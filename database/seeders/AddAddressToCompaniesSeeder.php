<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\City;
use App\Models\Province;
use App\Models\Region;
use App\Models\Country;
use Faker\Factory as Faker;

class AddAddressToCompaniesSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Get all companies
        $companies = Company::all();

        // Get all cities with their related province, region, and country
        $cities = City::with('province.region.country')->get();

        foreach ($companies as $company) {
            // Randomly select a city
            $city = $cities->random();

            // Assign address fields
            $company->update([
                'street' => $faker->streetAddress, // Random street name with number
                'city_id' => $city->id, // Random city ID
                'province_id' => $city->province_id, // Corresponding province ID
                'country_id' => $city->province->region->country_id, // Corresponding country ID
                'postal_code' => str_pad($faker->numberBetween(0, 99999), 5, '0', STR_PAD_LEFT), // Random 5-digit postal code
            ]);
        }
    }
}