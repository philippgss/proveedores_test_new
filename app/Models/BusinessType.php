<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'category_type'
    ];

    /**
     * Get the companies that belong to this business type.
     * Defines the many-to-many relationship with Company model
     */
    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    /**
     * Boot function to handle slug generation
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($businessType) {
            if (!$businessType->slug) {
                $businessType->slug = Str::slug($businessType->name);
            }
        });
    }
}