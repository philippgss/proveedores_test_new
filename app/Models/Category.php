<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Category extends Model
{
    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    // Add this helper method to get leaf categories (categories without children)
    public function scopeLeafCategories($query)
    {
        return $query->whereNotExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('categories as c')
                  ->whereColumn('c.parent_id', 'categories.id');
        });
    }
    
    public function descendants(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->with('descendants');
    }    
    
    // Define the "children" relationship (direct subcategories)
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }    
    

}
