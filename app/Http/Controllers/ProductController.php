<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin-products', [
            'products' => Product::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'productImage.*' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
            'detailImage' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
        ]);

        // Simpan multiple product images
        $productImages = [];
        if ($request->hasfile('productImage')) {
            foreach ($request->file('productImage') as $image) {
                $path = $image->store('product_images', 'public');
                $productImages[] = $path;
            }
        }

        // Simpan detail image
        $detailImagePath = null;
        if ($request->hasFile('detailImage')) {
            $detailImagePath = $request->file('detailImage')->store('detail_images', 'public');
        }

        // Simpan data ke database
        $product = new Product();
        $product->name = $validatedData['name'];
        $product->category = $validatedData['category'];
        $product->product_images = json_encode($productImages); // Simpan array images sebagai JSON
        $product->detail_image = $detailImagePath;
        $product->save();

        // Redirect kembali ke halaman admin dengan pesan sukses
        return redirect()->route('admin-products')->with('success', 'Product has been added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json([
            'data' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->title = $request->title;
        $product->content = $request->content;
        $product->save();

        return response()->json([
            'data' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    // Metode untuk menghapus produk berdasarkan ID
    public function destroy($id)
    {
        // Mencari produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Menghapus file gambar terkait dari storage
        if ($product->product_images) {
            foreach (json_decode($product->product_images) as $image) {
                Storage::delete($image); // Menghapus file dari storage
            }
        }

        if ($product->detail_image) {
            Storage::delete($product->detail_image); // Menghapus detail image
        }

        // Menghapus produk dari database
        $product->delete();

        // Mengembalikan redirect dengan pesan sukses
        return redirect()->route('admin-products')->with('success', 'Product and its images have been deleted successfully!');
    }
    // public function destroy($id)
    // {
    //     // Mencari produk berdasarkan ID
    //     $product = Product::findOrFail($id);

    //     // Menghapus produk dari database
    //     $product->delete();

    //     // Mengembalikan redirect dengan pesan sukses
    //     return redirect()->route('admin-products')->with('success', 'Product has been deleted successfully!');
    // }
}
