<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArticleCategory;

class ArticleCategoryController extends Controller
{
    public function store(Request $request)
    {
        dd($request);
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
}
