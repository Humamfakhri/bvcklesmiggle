<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name'
    ];

    // Relasi many-to-many dengan model Article
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_with_categories', 'category_id', 'article_id');
    }
}   
