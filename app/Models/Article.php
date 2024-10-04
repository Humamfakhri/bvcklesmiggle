<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
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

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when(
            $filters['search'] ?? false,
            fn($query, $search) =>
            $query->with('comments.user')
                ->where('title', 'LIKE', '%' . $search . '%')
                ->orWhere('author', 'LIKE', '%' . $search . '%')
                ->orWhere('body', 'LIKE', '%' . $search . '%')
                ->orWhereHas('categories', function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                })
        );

        $query->when(
            $filters['category'] ?? false,
            fn($query, $category) =>
            $query->WhereHas('categories', function ($query) use ($category) {
                $query->where('name', 'LIKE', '%' . $category . '%');
            })
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
