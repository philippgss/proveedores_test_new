<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Category;
use App\Services\CompanySearchService;

class CompaniesController extends Controller
{
		public function index(Request $request, $param1 = null, $param2 = null)
				{
		    // Existing logic to determine if we're handling a category or just pagination
		    $isCategoryRoute = $request->route()->named('companies.category.*');
		    
		    // Extract parameters based on route type
		    if ($isCategoryRoute) {
		        $categorySlug = $param1;
		        $page = $param2; // Will be null for non-paginated category route
		    } else {
		        $page = $param1; // Only relevant for `/proveedores-{page}`
		    }

		    // Initialize variables
		    $currentCategory = null;
		    $sidebarCategories = Category::whereNull('parent_id')->with('children')->get(); // Default to top-level categories
		    $siblingCategories = collect(); // Initialize as empty collection

		    // If a category is selected
		    if ($isCategoryRoute) {
		        $currentCategory = Category::where('slug', $categorySlug)->firstOrFail();

		        // If the current category is not a leaf, fetch its direct children (subcategories)
		        if ($currentCategory->children->isNotEmpty()) {
		            $sidebarCategories = $currentCategory->children;
		        } else {
		            // If it's a leaf category, fetch its siblings
		            if ($currentCategory->parent_id) {
		            		$sidebarCategories = collect();
		                $siblingCategories = Category::where('parent_id', $currentCategory->parent_id)
		                    ->where('id', '!=', $currentCategory->id) // Exclude the current category
		                    ->get(); 
		            }
		        }
		    }

		    // Base query
		    $query = Company::query()->with('categories');

		    // Apply category filtering if needed
		    if ($isCategoryRoute) {
		        $categoryIds = $this->getAllDescendantCategoryIds($currentCategory);
		        $categoryIds[] = $currentCategory->id;

		        $query->whereHas('categories', function($q) use ($categoryIds) {
		            $q->whereIn('categories.id', $categoryIds);
		        });
		    }

		    // Ordering and pagination
		    $companies = $query->orderBy('com_name', 'asc')
		        ->paginate(18, ['*'], 'page', $page)
		        ->withPath($this->getPaginationBasePath($request));

		    return view('companies.index', [
		        'companies' => $companies,
		        'category' => $isCategoryRoute ? $currentCategory : null, // Pass the current category (if any)
		        'sidebarCategories' => $sidebarCategories, // Pass categories for the sidebar (may be empty)
		        'siblingCategories' => $siblingCategories, // Pass sibling categories for the new widget
		    ]);
		}

		private function getAllDescendantCategoryIds(Category $category)
		{
			return $category->descendants->flatMap(function ($descendant) {
				return [$descendant->id, ...$this->getAllDescendantCategoryIds($descendant)];
			})->toArray();
		}

		private function getPaginationBasePath(Request $request)
		{
			if ($request->route()->named('companies.category.*')) {
				$categorySlug = $request->route()->parameter('category');
				return "/{$categorySlug}";
			}
			return '/proveedores';
		}

		public function search(Request $request)
		{
			$query = $request->input('query');
			$companies = app(CompanySearchService::class)->search($query);
			return view('companies.index', ['companies' => $companies]);
		}
			
}