<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin-products', [
            'products' => Product::get(),
            'categories' => ProductCategory::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // CATEGORY
        if ($request->has('categoryName')) {
            try {
                // Validasi data input
                $validatedData = $request->validate([
                    'categoryName' => 'required|string|max:255',
                ]);

                // Simpan data ke database
                $productCategory = new ProductCategory();
                $productCategory->name = $validatedData['categoryName'];
                $productCategory->save();

                // Redirect kembali ke halaman admin dengan pesan sukses
                return redirect('/sipalingadminB$/products')->with('success', 'Product Category has been added successfully!');
            } catch (Exception $e) {
                // Log error untuk debugging
                Log::error('Error updating product: ' . $e->getMessage());

                // Tampilkan pesan error ke user
                return redirect()->back()->with('error', 'An error occurred while updating the product. Please try again.');
            }
        }

        // Validasi data input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'linkShopee' => 'string',
            'linkTokopedia' => 'string',
            'thumbnail' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
            'productImage.*' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
            'issue' => 'required|string',
            'details' => 'required|string'
        ]);

        // Simpan multiple product images
        $productImages = [];

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailPath = $thumbnail->store('product_images', 'public');
            $productImages[] = $thumbnailPath;
        }

        if ($request->hasFile('productImage')) {
            foreach ($request->file('productImage') as $detailImage) {
                $detailPath = $detailImage->store('product_images', 'public');
                $productImages[] = $detailPath;
            }
        }

        // if ($request->hasfile('productImage')) {
        //     foreach ($request->file('productImage') as $image) {
        //         $path = $image->store('product_images', 'public');
        //         $productImages[] = $path;
        //     }
        // }

        // // Simpan detail image
        // $detailImagePath = null;
        // if ($request->hasFile('detailImage')) {
        //     $detailImagePath = $request->file('detailImage')->store('detail_images', 'public');
        // }

        // Simpan data ke database
        $product = new Product();
        $product->name = $validatedData['name'];
        $product->category = $validatedData['category'];
        $product->issue = $validatedData['issue'];
        $product->details = $validatedData['details'];
        $product->link_shopee = $validatedData['linkShopee'];
        $product->link_tokopedia = $validatedData['linkTokopedia'];
        $product->product_images = json_encode($productImages); // Simpan dalam format JSON
        // $product->product_images = json_encode($productImages); // Simpan array images sebagai JSON
        // $product->detail_image = $detailImagePath;
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
    public function update(Request $request, $id)
    {
        try {
            // Validasi data input
            $validatedData = $request->validate([
                'nameEdit' => 'required|string|max:255',
                'categoryEdit' => 'required|string|max:255',
                'linkShopeeEdit' => 'nullable|string',
                'linkTokopediaEdit' => 'nullable|string',
                'thumbnailEdit.*' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
                'productImageEdit.*' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
                // 'detailImageEdit' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
                'issueEdit' => 'required|string',
                'detailsEdit' => 'required|string'
            ]);

            // Cari produk berdasarkan ID
            $product = Product::findOrFail($id);

            // Simpan atau update multiple product images
            $productImagesEdit = json_decode($product->product_images, true); // Ambil gambar lama
            if ($request->hasfile('productImageEdit')) {
                // Hapus gambar lama dari storage
                foreach ($productImagesEdit as $image) {
                    Storage::disk('public')->delete($image);
                }

                // Simpan gambar baru
                $productImagesEdit = [];
                foreach ($request->file('productImageEdit') as $image) {
                    $path = $image->store('product_images', 'public');
                    $productImagesEdit[] = $path;
                }
            }

            // Simpan atau update detail image
            // $detailImagePathEdit = $product->detail_image; // Ambil gambar detail lama
            if ($request->hasFile('detailImageEdit')) {
                // Hapus gambar detail lama dari storage
                Storage::disk('public')->delete($product->detail_image);

                // Simpan gambar detail baru
                $detailImagePathEdit = $request->file('detailImageEdit')->store('detail_images', 'public');
            }

            // Update data produk di database
            $product->name = $validatedData['nameEdit'];
            $product->category = $validatedData['categoryEdit'];
            $product->link_shopee = $validatedData['linkShopeeEdit'];
            $product->link_tokopedia = $validatedData['linkTokopediaEdit'];
            $product->product_images = json_encode($productImagesEdit); // Simpan array images sebagai JSON
            $product->issue = $validatedData['issueEdit'];
            $product->details = $validatedData['detailsEdit'];
            // $product->detail_image = $detailImagePathEdit;
            $product->save();

            // Redirect kembali ke halaman admin dengan pesan sukses
            return redirect()->route('admin-products')->with('success', 'Product has been updated successfully!');
        } catch (Exception $e) {
            // Log error untuk debugging
            Log::error('Error updating product: ' . $e->getMessage());

            // Tampilkan pesan error ke user
            return redirect()->back()->with('error', 'An error occurred while updating the product. Please try again.');
        }
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
                Storage::disk('public')->delete($image);
            }
        }

        if ($product->detail_image) {
            Storage::disk('public')->delete($product->detail_image);
        }

        // Menghapus produk dari database
        $product->delete();

        // Mengembalikan redirect dengan pesan sukses
        return redirect()->route('admin-products')->with('success', 'Product have been deleted successfully!');
    }
}
