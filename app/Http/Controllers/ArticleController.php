<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\ArticleCategory;
use App\Models\Download;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class ArticleController extends Controller
{
    public function index(Request $request)
    {
        return view('articles', [
            'articles' => Article::filter(request(['category', 'search', 'sort']))->paginate(3)->withQueryString(),
            'categories' => ArticleCategory::get(),
            'downloads' => Download::get()
        ]);
        // if ($request->input('keyword')) {
        //     $keyword = $request->input('keyword');
        //     // dd($keyword);
        //     return view('articles', [
        //         'articles' => Article::with('comments.user')
        //             ->where('title', 'LIKE', '%'.$keyword.'%')
        //             ->orWhere('author', 'LIKE', '%'.$keyword.'%')
        //             ->orWhere('body', 'LIKE', '%'.$keyword.'%')
        //             // ->orWhereLike('author', $keyword)
        //             // ->orWhereLike('body', $keyword)
        //             ->orWhereHas('categories', function ($query) use ($keyword) {
        //                 $query->where('name', 'LIKE', '%'.$keyword.'%');
        //             })
        //             ->paginate(3),
        //         'categories' => ArticleCategory::get(),
        //         'downloads' => Download::get()
        //     ]);
        // } else {
        //     return view('articles', [
        //         'articles' => Article::with('comments.user')->paginate(3),
        //         'categories' => ArticleCategory::get(),
        //         'downloads' => Download::get()
        //     ]);
        // }
    }

    public function show($slug) 
    {
        return view('articles', [
            'articles' => Article::where('slug', $slug)->paginate(3),
            'article' => Article::where('slug', $slug)->firstOrFail(),
            'categories' => ArticleCategory::get(),
            'downloads' => Download::get()
        ]);
    }

    // public function show($slug) 
    // {
    //     // $slug = Str::slug($title);
    //     return view('articles', [
    //         'articles' => Article::whereRaw("LOWER(REPLACE(title, ' ', '-')) = ?", [$slug])->get(),
    //         'article' => Article::whereRaw("LOWER(REPLACE(title, ' ', '-')) = ?", [$slug])->firstOrFail(),
    //         'categories' => ArticleCategory::get(),
    //         'downloads' => Download::get()
    //     ]);
    // }

    // public function show($id) 
    // {
    //     // $article = Article::findOrFail($id);
    //     return view('articles', [
    //         'articles' => Article::where('id', $id)->get(),
    //         'article' => Article::find($id),
    //         // 'articles' => Article::where('id', $id)->with('comments.user')->get(),
    //         'categories' => ArticleCategory::get(),
    //         'downloads' => Download::get()
    //     ]);
    // }

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
