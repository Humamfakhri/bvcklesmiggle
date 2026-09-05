<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ArticleCategory;
use App\Models\ArticleWithCategory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Support\HtmlSanitizer;

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
        try {
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
            } else {
                // ARTICLE
                $validatedData = $request->validate([
                    'title' => 'required|string|min:3|max:255',
                    'author' => 'required|string|min:2|max:255',
                    'category' => 'required|string|min:2|max:255',
                    'articleImage' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
                    'body' => 'required|string|min:20',
                ], [
                    'title.required' => 'Article title is required.',
                    'title.min' => 'Article title must be at least 3 characters.',
                    'author.required' => 'Author name is required.',
                    'author.min' => 'Author name must be at least 2 characters.',
                    'category.required' => 'Please select an article category.',
                    'body.required' => 'Article content is required.',
                    'body.min' => 'Article body must be at least 20 characters long.',
                    'articleImage.image' => 'The article image must be a valid image file.',
                ]);

                // Simpan detail image
                $articleImagePath = null;
                if ($request->hasFile('articleImage')) {
                    $articleImagePath = $request->file('articleImage')->store('article_images', 'public');
                }

                $pureTitle = strip_tags($validatedData['title']); // "Judul Artikel"
                $slug = Str::slug($pureTitle); // "judul-artikel"

                // Simpan data ke database
                $article = new Article();
                $article->title = strip_tags($validatedData['title']);
                $article->pure_title = $pureTitle;
                $article->slug = $slug;
                $article->author = strip_tags($validatedData['author']);
                $article->image = $articleImagePath;
                $article->body = HtmlSanitizer::sanitize($validatedData['body']);
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
            }
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
                'titleEdit' => 'required|string|min:3|max:255',
                'authorEdit' => 'required|string|min:2|max:255',
                'categoryEdit' => 'required|string|min:2|max:255',
                'articleImageEdit' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
                'bodyEdit' => 'required|string|min:20',
            ], [
                'titleEdit.required' => 'Article title is required.',
                'titleEdit.min' => 'Article title must be at least 3 characters.',
                'authorEdit.required' => 'Author name is required.',
                'authorEdit.min' => 'Author name must be at least 2 characters.',
                'categoryEdit.required' => 'Please select an article category.',
                'bodyEdit.required' => 'Article content is required.',
                'bodyEdit.min' => 'Article body must be at least 20 characters long.',
                'articleImageEdit.image' => 'The article image must be a valid image file.',
            ]);

            // Cari produk berdasarkan ID
            $article = Article::findOrFail($id);
            // $articleWithCategory = ArticleWithCategory::where('article_id', $id)->first();
            $articleWithCategory = ArticleWithCategory::firstOrNew(['article_id' => $id]);
            // dd($articleWithCategory);
            $categoryId = ArticleCategory::where('name', $validatedData['categoryEdit'])->value('id');
            // dd($categoryId);

            // Simpan atau update detail image
            $articleImagePathEdit = $article->image; // Ambil gambar article lama
            if ($request->hasFile('articleImageEdit')) {
                // Hapus gambar article lama dari storage
                Storage::disk('public')->delete($article->image);

                // Simpan gambar article baru
                $articleImagePathEdit = $request->file('articleImageEdit')->store('article_images', 'public');
            }


            $pureTitle = strip_tags($validatedData['titleEdit']); // "Judul Artikel"
            $slug = Str::slug($pureTitle); // "judul-artikel"

            $articleWithCategory->category_id = $categoryId;
            $articleWithCategory->save();

            $article->title = strip_tags($validatedData['titleEdit']);
            $article->pure_title = $pureTitle;
            $article->slug = $slug;
            $article->author = strip_tags($validatedData['authorEdit']);
            $article->body = HtmlSanitizer::sanitize($validatedData['bodyEdit']);
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
