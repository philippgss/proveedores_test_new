<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Company;

class CategoryController extends Controller
{
		public function show($slug, $page = null)  // Add $page parameter
		{
		    $category = Category::where('slug', $slug)->firstOrFail();
		    
		    // Get all descendant categories including the current one
		    $categoryIds = $this->getAllDescendantCategoryIds($category);
		    $categoryIds[] = $category->id;
		    
		    $companies = Company::whereHas('categories', function($query) use ($categoryIds) {
		            $query->whereIn('categories.id', $categoryIds);
		        })
		        ->with('categories')
		        ->orderBy('created_at', 'desc')
		        ->paginate(18, ['*'], 'page', $page); // Add page parameter here
		    
		    return view('categories.show', compact('category', 'companies'));
		}
		
    //moved to CompaniesController
    /****
    private function getAllDescendantCategoryIds($category)   
    {
        $ids = $category->descendants->pluck('id')->toArray();

        foreach ($category->descendants as $descendant) {
            $ids = array_merge($ids, $this->getAllDescendantCategoryIds($descendant));
        }

        return $ids;
    }
    **********/		
}
