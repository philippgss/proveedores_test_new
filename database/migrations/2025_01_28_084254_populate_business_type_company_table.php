<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Company;
use App\Models\Category;
use App\Models\BusinessType;
use App\Models\CategoryType;
use Illuminate\Support\Facades\DB;

class PopulateBusinessTypeCompanyTable extends Migration
{
    public function up()
    {
        // Clear existing relationships
        DB::table('business_type_company')->truncate();

        $companies = Company::with('categories')->get();
        
        foreach ($companies as $company) {
            $processedTopLevelCategories = [];
            
            foreach ($company->categories as $category) {
                // Find top-level parent
                $topParent = $this->findTopLevelParent($category);
                
                // Skip if we already processed this top-level category
                if (in_array($topParent->id, $processedTopLevelCategories)) {
                    continue;
                }
                
                $processedTopLevelCategories[] = $topParent->id;
                
                // Get category type (service/product)
                $categoryType = CategoryType::where('category_id', $topParent->id)->first();
                
                if ($categoryType) {
                    if ($categoryType->type === 'service') {
                        // Assign Servicios (assuming it's ID 4)
                        $company->businessTypes()->syncWithoutDetaching([4]);
                    } else if ($categoryType->type === 'product') {
                        // Random product business type (IDs 1,2,3,5)
                        $productTypeIds = [1, 2, 3, 5];
                        $randomProductTypeId = $productTypeIds[array_rand($productTypeIds)];
                        $company->businessTypes()->syncWithoutDetaching([$randomProductTypeId]);
                    }
                }
            }
            
            // For companies with odd IDs, try to assign a third business type
            if ($company->id % 2 !== 0 && $company->businessTypes->count() < 2) {
                $existingTypeIds = $company->businessTypes->pluck('id')->toArray();
                $availableTypes = BusinessType::whereNotIn('id', $existingTypeIds)->get();
                
                if ($availableTypes->count() > 0) {
                    $randomType = $availableTypes->random();
                    $company->businessTypes()->syncWithoutDetaching([$randomType->id]);
                }
            }
        }
    }

    private function findTopLevelParent($category)
    {
        if (!$category->parent_id) {
            return $category;
        }
        
        $parent = Category::find($category->parent_id);
        return $this->findTopLevelParent($parent);
    }

    public function down()
    {
        DB::table('business_type_company')->truncate();
    }
}