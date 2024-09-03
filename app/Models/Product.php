<?php

namespace App\Models;

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
}
