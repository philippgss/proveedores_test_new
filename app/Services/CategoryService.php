<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    /**
     * Get all descendant category IDs for a given category.
     *
     * @param Category $category
     * @return array
     */
    public function getAllDescendantCategoryIds(Category $category)
    {
        return $category->descendants->flatMap(function ($descendant) {
            return [$descendant->id, ...$this->getAllDescendantCategoryIds($descendant)];
        })->toArray();
    }
}