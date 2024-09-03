<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\ArticleCategory;
use App\Models\ArticleWithComment;
use Illuminate\Support\Facades\Log;
use Exception;

class ArticleController extends Controller
{
    public function index()
    {
        return view('articles', [
            'articles' => Article::paginate(3),
            'categories' => ArticleCategory::get()
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

    // public function storeComment(Request $request) 
    // {
    //     try {
    //         $request->validate([
    //             'articleId' => 'required',
    //             'content' => 'required|string|max:1000',
    //         ]);
    
    //         $article = Article::findOrFail($articleId);
    
    //         $article->comments()->create([
    //             'user_id' => auth()->id(),
    //             'content' => $request->content,
    //         ]);
    
    //         return redirect()->route('articles.show', $articleId)->with('success', 'Comment has been added successfully!');
    //     // return redirect()->route('articles')->with('success', 'Comment has been added successfully!');
    //     } catch (Exception $e) {
    //         // Log error untuk debugging
    //         Log::error('Error adding comment: ' . $e->getMessage());

    //         // Tampilkan pesan error ke user
    //         return redirect()->back()->with('error', $e->getMessage());
    //     }
    // }
}
