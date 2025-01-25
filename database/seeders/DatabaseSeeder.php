<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call all seeders in the correct order
        $this->call([
            CountrySeeder::class,
            RegionSeeder::class,
            ProvinceSeeder::class,
            CitySeeder::class,
            CompanySeeder::class,
            CategorySeeder::class,
            CategoryCompanySeeder::class,
            AddAddressToCompaniesSeeder::class,
        ]);
    }
}