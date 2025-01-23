<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
		public function run()
		{
		    // Clear existing relationships to avoid duplicates
		    DB::table('category_company')->truncate();

		    // Get all companies and leaf categories
		    $companies = Company::all();
		    $leafCategories = Category::leafCategories()->get();

		    foreach ($companies as $company) {
		        // Randomly select 1-3 leaf categories
		        $randomCategories = $leafCategories->random(rand(1, 3));
		        
		        // Attach categories to company
		        $company->categories()->attach($randomCategories->pluck('id'));
		    }
		}
}
