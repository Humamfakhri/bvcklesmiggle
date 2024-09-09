<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\ArticleCategory;
use App\Models\ArticleWithComment;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
            // dd($keyword);
            return view('articles', [
                'articles' => Article::with('comments.user')
                    ->where('title', 'LIKE', '%'.$keyword.'%')
                    ->orWhere('author', 'LIKE', '%'.$keyword.'%')
                    ->orWhere('body', 'LIKE', '%'.$keyword.'%')
                    // ->orWhereLike('author', $keyword)
                    // ->orWhereLike('body', $keyword)
                    ->orWhereHas('categories', function ($query) use ($keyword) {
                        $query->where('name', 'LIKE', '%'.$keyword.'%');
                    })
                    ->paginate(3),
                'categories' => ArticleCategory::get()
            ]);
        } else {
            return view('articles', [
                'articles' => Article::with('comments.user')->paginate(3),
                'categories' => ArticleCategory::get()
            ]);
        }
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

    public function storeComment(Request $request)
    {
        $articleId = $request->articleId;

        try {
            // Validasi input
            $request->validate([
                'name' => 'nullable|string',
                'email' => 'required|string|email',
                'content' => 'required|string|max:1000',
            ]);

            // Cek apakah user sudah ada berdasarkan email
            $user = User::where('email', $request->email)->first();

            // Jika user tidak ada, buat user baru
            if (!$user) {
                $user = User::create([
                    'name' => $request->name ?? 'Anonymous', // Default name if not provided
                    'email' => $request->email,
                ]);
            }

            // Masukkan data ke tabel Comments
            Comment::create([
                'article_id' => $articleId,
                'user_id' => $user->id,
                'content' => $request->content,
            ]);

            // Redirect ke artikel dengan pesan sukses
            return redirect()->route('articles')->with('success', 'Comment has been added successfully!');
        } catch (Exception $e) {
            // Log error untuk debugging
            Log::error('Error adding comment: ' . $e->getMessage());

            // Tampilkan pesan error ke user
            return redirect()->back()->with('error', 'There was an error adding your comment. Please try again.');
        }
    }
}
