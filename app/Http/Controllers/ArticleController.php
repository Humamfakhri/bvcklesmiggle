<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return view('articles', [
            'articles' => Article::get()
        ]);
    }

    public function getArticle(Request $request)
    {
        // Validasi ID
        $request->validate([
            'id' => 'required|integer|exists:articles,id',
        ]);

        // Mendapatkan nama produk berdasarkan ID
        $article = Article::findOrFail($request->id);

        // Mengirim data sebagai JSON        
        // return response()->json(['article' => $article]);
        return response()->json($article);
    }
}
