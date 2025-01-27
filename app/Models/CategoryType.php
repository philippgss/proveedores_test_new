<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'type'
    ];

    /**
     * The possible types of categories.
     */
    public const TYPES = [
        'product',
        'service'
    ];

    /**
     * Get the category that owns the category type.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Scope a query to only include product types.
     */
    public function scopeProducts($query)
    {
        return $query->where('type', 'product');
    }

    /**
     * Scope a query to only include service types.
     */
    public function scopeServices($query)
    {
        return $query->where('type', 'service');
    }
}