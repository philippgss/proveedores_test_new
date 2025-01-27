<?php


namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Category;
use App\Models\Province;
use App\Models\City;
use App\Models\TipoProv;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    // Default index method for /proveedores
    public function index()
    {
        // Return all companies, sorted alphabetically and paginated
        $companies = Company::orderBy('name', 'asc')->paginate(18);
        return view('companies.index', compact('companies'));
    }

    // Handle single directory route (/term)
    public function filterByTerm($term)
    {
        // Check if term is a category, province, or city
        if ($category = Category::where('slug', $term)->first()) {
            // Filter by category
            $companies = Company::whereHas('categories', function ($q) use ($category) {
                    $q->where('categories.id', $category->id);
                })
                ->orderBy('name', 'asc')
                ->paginate(18);
            return view('companies.index', compact('companies', 'category'));
        } elseif ($province = Province::where('slug', $term)->first()) {
            // Filter by province
            $companies = Company::whereHas('provinces', function ($q) use ($province) {
                    $q->where('provinces.id', $province->id);
                })
                ->orderBy('name', 'asc')
                ->paginate(18);
            return view('companies.index', compact('companies', 'province'));
        } elseif ($city = City::where('slug', $term)->first()) {
            // Filter by city
            $companies = Company::whereHas('cities', function ($q) use ($city) {
                    $q->where('cities.id', $city->id);
                })
                ->orderBy('name', 'asc')
                ->paginate(18);
            return view('companies.index', compact('companies', 'city'));
        }

        // If no match, return 404
        abort(404);
    }

    // Handle tipoProv and category combination (xyz_t/xyz)
    public function tipoProvIndex($tipoProvSlug, $categorySlug)
    {
        // Find tipoProv and category
        $tipoProv = TipoProv::where('slug', $tipoProvSlug)->firstOrFail();
        $category = Category::where('slug', $categorySlug)->firstOrFail();

        // Filter companies by tipoProv and category
        $companies = Company::whereHas('tipoProvs', function ($q) use ($tipoProv) {
                $q->where('tipo_provs.id', $tipoProv->id);
            })
            ->whereHas('categories', function ($q) use ($category) {
                $q->where('categories.id', $category->id);
            })
            ->orderBy('name', 'asc')
            ->paginate(18);

        return view('companies.index', compact('companies', 'tipoProv', 'category'));
    }

    // Handle category and province combination (term1/term2)
    public function categoryProvinceIndex($categorySlug, $provinceSlug)
    {
        // Find category and province
        $category = Category::where('slug', $categorySlug)->firstOrFail();
        $province = Province::where('slug', $provinceSlug)->firstOrFail();

        // Filter companies by category and province
        $companies = Company::whereHas('categories', function ($q) use ($category) {
                $q->where('categories.id', $category->id);
            })
            ->whereHas('provinces', function ($q) use ($province) {
                $q->where('provinces.id', $province->id);
            })
            ->orderBy('name', 'asc')
            ->paginate(18);

        return view('companies.index', compact('companies', 'category', 'province'));
    }

    // Handle category and city combination (term1/term2)
    public function categoryCityIndex($categorySlug, $citySlug)
    {
        // Find category and city
        $category = Category::where('slug', $categorySlug)->firstOrFail();
        $city = City::where('slug', $citySlug)->firstOrFail();

        // Filter companies by category and city
        $companies = Company::whereHas('categories', function ($q) use ($category) {
                $q->where('categories.id', $category->id);
            })
            ->whereHas('cities', function ($q) use ($city) {
                $q->where('cities.id', $city->id);
            })
            ->orderBy('name', 'asc')
            ->paginate(18);

        return view('companies.index', compact('companies', 'category', 'city'));
    }

    // Search method (already defined in routes)
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Perform search logic (adjust as needed)
        $companies = Company::where('name', 'like', "%{$query}%")
            ->orderBy('name', 'asc')
            ->paginate(18);

        return view('companies.index', compact('companies', 'query'));
    }
}

		public function search(Request $request)
		{
			$query = $request->input('query');
			$page = $request->input('page', 1); // Get the page parameter from the query string (default to 1)
			$perPage = $request->input('perPage', 18); // Default to 18 items per page
			$categoryId = $request->input('category'); // Get the selected category ID
		
			// Fetch sidebar categories
			$sidebarCategories = collect();
			$siblingCategories = collect();
			$sidebarGeo = collect();
		
			if ($categoryId) {
				// Fetch the selected category
				$selectedCategory = \App\Models\Category::find($categoryId);
				if ($selectedCategory) {
					if ($selectedCategory->children->isNotEmpty()) {
						// If the selected category has children, display them
						$sidebarCategories = $selectedCategory->children;
					} else {
						// If it's a leaf category, fetch its siblings
						if ($selectedCategory->parent_id) {
							$siblingCategories = \App\Models\Category::where('parent_id', $selectedCategory->parent_id)
								->where('id', '!=', $selectedCategory->id) // Exclude the current category
								->get();
						}
					}
				}
			} else {
				// Default to top-level categories if no category is selected
				$sidebarCategories = \App\Models\Category::whereNull('parent_id')->get();
			}
		
			// Filter companies by category if a category is selected
			$companies = app(CompanySearchService::class)->search($query, $perPage, $page, $categoryId);
		
			return view('companies.index', [
				'companies' => $companies,
				'sidebarCategories' => $sidebarCategories,
				'siblingCategories' => $siblingCategories,
				'selectedCategory' => $categoryId, // Pass the selected category to the view
				'sidebarGeo' => $sidebarGeo,
			]);
		}

}