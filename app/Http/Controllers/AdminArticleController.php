<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\ArticleCategory;
use App\Models\ArticleWithCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Exception;

class AdminArticleController extends Controller
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
            'category' => 'required|string|max:255',
            'articleImage' => 'image|mimes:jpeg,jpg,png,webp|max:2048',
            'body' => 'required|string',
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

        $categoryId = ArticleCategory::where('name', $validatedData['category'])->value('id');

        ArticleWithCategory::create([
            'article_id' => $article->id,
            'category_id' => $categoryId
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

    public function update(Request $request, $id)
    {
        try {
            // Validasi data input
            $validatedData = $request->validate([
                'titleEdit' => 'required|string|max:255',
                'authorEdit' => 'required|string|max:255',
                'categoryEdit' => 'required|string|max:255',
                'articleImageEdit' => 'image|mimes:jpeg,jpg,png,webp|max:2048',
                'bodyEdit' => 'required|string',
            ]);

            // Cari produk berdasarkan ID
            $article = Article::findOrFail($id);

            // Simpan atau update detail image
            $articleImagePathEdit = $article->image; // Ambil gambar article lama
            if ($request->hasFile('articleImageEdit')) {
                // Hapus gambar article lama dari storage
                Storage::disk('public')->delete($article->image);

                // Simpan gambar article baru
                $articleImagePathEdit = $request->file('articleImageEdit')->store('article_images', 'public');
            }

            // Update data produk di database
            $article->title = $validatedData['titleEdit'];
            $article->author = $validatedData['authorEdit'];
            $article->body = $validatedData['bodyEdit'];
            $article->image = $articleImagePathEdit;
            $article->save();
            // $article->category = $validatedData['categoryEdit'];

            // Redirect kembali ke halaman admin dengan pesan sukses
            return redirect()->route('admin-articles')->with('success', 'Article has been updated successfully!');
        } catch (Exception $e) {
            // Log error untuk debugging
            Log::error('Error updating article: ' . $e->getMessage());

            // Tampilkan pesan error ke user
            return redirect()->back()->with('error', 'An error occurred while updating the article. Please try again.');
        }
    }

    public function destroy($id)
    {
        // Mencari produk berdasarkan ID
        $article = Article::findOrFail($id);

        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        // Menghapus produk dari database
        $article->delete();

        // Mengembalikan redirect dengan pesan sukses
        return redirect()->route('admin-articles')->with('success', 'Article have been deleted successfully!');
    }
}
