<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'link_shopee',
        'link_tokopedia',
        'product_images',
        'issue',
        'details'
    ];

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'product_with_categories', 'product_id', 'category_id');
    }

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when(
            $filters['search'] ?? false,
            fn($query, $search) =>
            $query->where('name', 'like', '%' . $search . '%')
        );

        $query->when(
            $filters['category'] ?? false,
            fn($query, $category) =>
            $query->where('category', $category)
        );
        $query->when(
            $filters['sort'] ?? false,
            fn($query, $sort) =>
            $sort === 'oldest' ? $query->oldest() : $query->latest(),
            fn($query) => $query->latest() // Default to latest if no sort parameter
        );
        // $query->when($filters['search'] ?? false, fn ($query, $search) => $query->where('name', 'like', '%' . $search . '%'));
    }
}
