<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;  // Add this import!

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Let's create 200 companies
        for ($i = 0; $i < 200; $i++) {
            $companyName = fake()->company();
            DB::table('companies')->insert([
                'com_name' => $companyName,
                'slug' => Str::slug($companyName), // Generate slug from company name
                'com_description' => fake()->paragraph(4),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}