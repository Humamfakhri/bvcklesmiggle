<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Simpan data ke database
        $product = new ProductCategory();
        $product->name = $validatedData['name'];
        $product->save();

        // Redirect kembali ke halaman admin dengan pesan sukses
        return redirect()->route('admin-products')->with('success', 'Product Category has been added successfully!');
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Product $product)
    // {
    //     $product->title = $request->title;
    //     $product->content = $request->content;
    //     $product->save();

    //     return response()->json([
    //         'data' => $product
    //     ]);
    // }

    /**
     * Remove the specified resource from storage.
     */
    // Metode untuk menghapus produk berdasarkan ID
    public function destroy($id)
    {
        // Mencari produk berdasarkan ID
        $productCategory = ProductCategory::findOrFail($id);

        // Menghapus produk dari database
        $productCategory->delete();

        // Mengembalikan redirect dengan pesan sukses
        return redirect()->route('admin-products')->with('success', 'Product Category have been deleted successfully!');
    }
}
