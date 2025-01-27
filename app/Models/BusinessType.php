<?php

// app/Models/BusinessType.php
class BusinessType extends Model
{
    protected $fillable = ['name', 'slug', 'category_type'];
}

// app/Models/CategoryType.php
class CategoryType extends Model
{
    protected $fillable = ['category_id', 'type'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}