<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
    'title',
    'author',
    'image',
    'body',
    ];

    // Relasi many-to-many dengan model Category
    public function categories()
    {
        return $this->belongsToMany(ArticleCategory::class, 'article_with_categories', 'article_id', 'category_id');
    }
}
