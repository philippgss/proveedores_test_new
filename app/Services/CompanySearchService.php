<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Category;
use App\Services\CategoryService;


class CompanySearchService
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function search($query, $perPage = 18, $page = 1, $categoryId = null)
    {
        // Base query for exact matches
        $exactQuery = Company::whereRaw('LOWER(com_name) LIKE ?', [strtolower($query)]);
        if ($categoryId) {
            $category = Category::find($categoryId);
            if ($category) {
                $descendantCategoryIds = $this->categoryService->getAllDescendantCategoryIds($category);
                $descendantCategoryIds[] = $categoryId; // Include the parent category ID
                $exactQuery->whereHas('categories', function ($q) use ($descendantCategoryIds) {
                    $q->whereIn('categories.id', $descendantCategoryIds); // Filter by descendant categories
                });
            }
        }

        // Base query for partial matches
        $partialQuery = Company::whereRaw('LOWER(com_name) LIKE ?', ['%' . strtolower($query) . '%'])
            ->orWhereRaw('LOWER(com_description) LIKE ?', ['%' . strtolower($query) . '%']);
        if ($categoryId) {
            $category = Category::find($categoryId);
            if ($category) {
                $descendantCategoryIds = $this->categoryService->getAllDescendantCategoryIds($category);
                $descendantCategoryIds[] = $categoryId; // Include the parent category ID
                $partialQuery->whereHas('categories', function ($q) use ($descendantCategoryIds) {
                    $q->whereIn('categories.id', $descendantCategoryIds); // Filter by descendant categories
                });
            }
        }

        // Fetch exact and partial matches
        $exactMatches = $exactQuery->paginate($perPage, ['*'], 'exact_page', $page);
        $partialMatches = $partialQuery->whereNotIn('id', $exactMatches->pluck('id'))
            ->paginate($perPage, ['*'], 'partial_page', $page);

        // Combine results with exact matches first
        $companies = $exactMatches->concat($partialMatches);

        // Manually create a LengthAwarePaginator for the combined results
        return new \Illuminate\Pagination\LengthAwarePaginator(
            $companies,
            $exactMatches->total() + $partialMatches->total(),
            $perPage,
            $page, // Use the provided page
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }
}