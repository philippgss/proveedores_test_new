<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\CategoryController;

class CompanyController extends Controller
{
		public function show($slug)
		{
		    $company = Company::where('slug', $slug)
		        ->with('categories.descendants') // Fetch categories and their descendants
		        ->firstOrFail();

		    // Group categories by top-level parent
		    $groupedCategories = $this->groupCategoriesByTopLevelParent($company->categories);

		    return view('companies.show', [
		        'company' => $company,
		        'groupedCategories' => $groupedCategories,
		    ]);
		}
		
		private function groupCategoriesByTopLevelParent($categories)
		{
		    $grouped = [];

		    foreach ($categories as $category) {
		        // Find the top-level parent for this category
		        $topLevelParent = $this->findTopLevelParent($category);

		        // Initialize the group if it doesn't exist
		        if (!isset($grouped[$topLevelParent->id])) {
		            $grouped[$topLevelParent->id] = [
		                'parent' => $topLevelParent,
		                'children' => [],
		            ];
		        }

		        // Add the category and its descendants to the group
		        $grouped[$topLevelParent->id]['children'] = array_merge(
		            $grouped[$topLevelParent->id]['children'],
		            $this->flattenDescendants($category)
		        );
		    }

		    return $grouped;
		}

		private function findTopLevelParent($category)
		{
		    while ($category->parent_id !== null) {
		        $category = Category::find($category->parent_id);
		    }
		    return $category;
		}

		private function flattenDescendants($category)
		{
		    $descendants = [$category];
		    foreach ($category->descendants as $descendant) {
		        $descendants = array_merge($descendants, $this->flattenDescendants($descendant));
		    }
		    return $descendants;
		}	
}
