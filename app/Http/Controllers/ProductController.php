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
    public function index(Request $request)
    {
        return view('products', [
            'products' => Product::filter(request(['category', 'search', 'sort']))->paginate(12),
            // 'products' => Product::filter(request(['category', 'search', 'sort']))->paginate(1)->withQueryString(),
            'categories' => Product::distinct()->pluck('category')
        ]);
        // if ($request->input('category')) {   
        //     $category = $request->input('category');
        //     return view('products', [
        //         'products' =>
        //         Product::where('category', $category)->get(),
        //         'categories' => Product::distinct()->pluck('category')
        //     ]);
        // } else {
        //     return view('products', [
        //         'products' =>
        //         Product::get(),
        //         'categories' => Product::distinct()->pluck('category')
        //     ]);
        // }
    }

    public function getProduct(Request $request)
    {

        // Validasi ID
        $request->validate([
            'id' => 'required|integer|exists:products,id',
        ]);

        // Mendapatkan produk berdasarkan ID
        $product = Product::findOrFail($request->id);

        // Mengubah JSON string menjadi array
        $imagesArray = json_decode($product->product_images, true);

        // Mengubah data produk menjadi array dan menambahkan images array
        $productData = $product->toArray();
        $productData['product_images'] = $imagesArray;

        // Mengirim data sebagai JSON
        return response()->json($productData);

        // // Validasi ID
        // $request->validate([
        //     'id' => 'required|integer|exists:products,id',
        // ]);

        // // Mendapatkan nama produk berdasarkan ID
        // $product = Product::findOrFail($request->id);

        // // Mengirim data sebagai JSON        
        // // return response()->json(['product' => $product]);
        // return response()->json($product);
    }

    /**
     * Store a newly created resource in storage.
     */
    // FUNGSI STORE DIPINDAH KE ADMIN

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
        return redirect()->route('admin-products')->with('success', 'Product have been deleted successfully!');
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
