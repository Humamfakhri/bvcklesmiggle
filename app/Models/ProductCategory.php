<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    // Relasi many-to-many dengan model Product
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_with_categories', 'category_id', 'product_id');
    }
}
