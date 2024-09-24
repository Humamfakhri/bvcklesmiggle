<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Partnership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminPartnershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin-partnerships', [
            'partnerships' => Partnership::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validasi data input
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
                'link' => 'string',
            ]);

            // Simpan detail image
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('partnership_images', 'public');
            }

            // Simpan data ke database
            $partnership = new Partnership();
            $partnership->name = $validatedData['name'];
            $partnership->image = $imagePath;
            $partnership->link = $validatedData['link'];
            $partnership->save();

            // Redirect kembali ke halaman admin dengan pesan sukses
            return redirect()->route('admin-partnerships')->with('success', 'Partnership has been added successfully!');
        } catch (Exception $e) {
            // Log error untuk debugging
            Log::error('Error adding partnership: ' . $e->getMessage());

            // Tampilkan pesan error ke user
            return redirect()->back()->with('error', 'An error occurred while updating the partnership. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Partnership $partnership)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partnership $partnership)
    {
        //
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
                'imageEdit.*' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
                'linkEdit' => 'string',
            ]);

            // Cari produk berdasarkan ID
            $partnership = Partnership::findOrFail($id);

            // Simpan atau update detail image
            $imageEditPath = $partnership->image; // Ambil gambar detail lama
            if ($request->hasFile('imageEdit')) {
                // Hapus gambar detail lama dari storage
                Storage::disk('public')->delete($partnership->image);

                // Simpan gambar detail baru
                $imageEditPath = $request->file('imageEdit')->store('partnership_images', 'public');
            }

            // Update data produk di database
            $partnership->name = $validatedData['nameEdit'];
            $partnership->image = $imageEditPath;
            $partnership->link = $validatedData['linkEdit'];
            $partnership->save();

            // Redirect kembali ke halaman admin dengan pesan sukses
            return redirect()->route('admin-partnerships')->with('success', 'Partnership has been updated successfully!');
        } catch (Exception $e) {
            // Log error untuk debugging
            Log::error('Error updating partnership: ' . $e->getMessage());

            // Tampilkan pesan error ke user
            return redirect()->back()->with('error', 'An error occurred while updating the partnership. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Mencari produk berdasarkan ID
        $partnership = Partnership::findOrFail($id);

        // Menghapus file gambar terkait dari storage
        if ($partnership->image) {
            Storage::disk('public')->delete($partnership->image);
        }

        // Menghapus produk dari database
        $partnership->delete();

        // Mengembalikan redirect dengan pesan sukses
        return redirect()->route('admin-partnerships')->with('success', 'Partnership have been deleted successfully!');
    }
}
