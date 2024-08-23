<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\ArticleCategory;
use App\Models\ArticleWithCategory;
use Illuminate\Support\Facades\Log;
use Exception;

class ArticleController extends Controller
{
    public function index()
    {
        return view('admin-articles', [
            // 'articles' => Article::get(),
            'articles' => Article::with('categories')->get(),
            'categories' => ArticleCategory::get()
        ]);
    }

    public function store(Request $request)
    {
        // CATEGORY
        if ($request->has('name')) {
            // Validasi data input
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
            ]);

            // Simpan data ke database
            $articleCategory = new ArticleCategory();
            $articleCategory->name = $validatedData['name'];
            $articleCategory->save();

            // Redirect kembali ke halaman admin dengan pesan sukses
            return redirect()->route('admin-articles')->with('success', 'Article Category has been added successfully!');
        }

        try {
        // ARTICLE
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'categoryId' => 'required|string|max:255',
            'articleImage' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
            'body' => 'string',
        ]);

        // Simpan detail image
        $articleImagePath = null;
        if ($request->hasFile('articleImage')) {
            $articleImagePath = $request->file('articleImage')->store('article_images', 'public');
        }

        // Simpan data ke database
        $article = new Article();
        $article->title = $validatedData['title'];
        $article->author = $validatedData['author'];
        $article->image = $articleImagePath;
        $article->body = $validatedData['body'];
        $article->save();

        // Simpan kategori (atau bisa juga cari jika sudah ada)
        // $category = ArticleCategory::firstOrCreate(['name' => $validatedData['category']]);

        ArticleWithCategory::create([
            'article_id' => $article->id,
            'category_id' => $validatedData['categoryId']
        ]);


        // Redirect kembali ke halaman admin dengan pesan sukses
        return redirect()->route('admin-articles')->with('success', 'Article has been added successfully!');
        } catch (Exception $e) {
            // Log error untuk debugging
            Log::error('Error updating article: ' . $e->getMessage());

            // Tampilkan pesan error ke user
            return redirect()->back()->with('error', 'An error occurred while updating the article. Please try again.');
        }
    }
}
