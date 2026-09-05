<?php

namespace App\Http\Controllers;

use App\Models\Download;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AdminDownloadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin-downloads', [
            'downloads' => Download::get(),
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
                'title' => 'required|string|min:3|max:255',
                'link' => ['required', 'url', 'max:255'],
            ], [
                'title.required' => 'Download title is required.',
                'title.min' => 'Download title must be at least 3 characters.',
                'link.required' => 'Download link is required.',
                'link.url' => 'Download link must be a valid URL.',
            ]);

            // Simpan data ke database
            $download = new Download();
            $download->title = $validatedData['title'];
            $download->link = $validatedData['link'];
            $download->save();

            // Redirect kembali ke halaman admin dengan pesan sukses
            return redirect()->route('admin-downloads')->with('success', 'Download has been added successfully!');
        } catch (ValidationException $e) {
            throw $e;
        } catch (Exception $e) {
            // Log error untuk debugging
            Log::error('Error adding download: ' . $e->getMessage());

            // Tampilkan pesan error ke user
            return redirect()->back()->with('error', 'An error occurred while updating the download. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Download $download)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Download $download)
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
                'titleEdit' => 'required|string|min:3|max:255',
                'linkEdit' => ['required', 'url', 'max:255'],
            ], [
                'titleEdit.required' => 'Download title is required.',
                'titleEdit.min' => 'Download title must be at least 3 characters.',
                'linkEdit.required' => 'Download link is required.',
                'linkEdit.url' => 'Download link must be a valid URL.',
            ]);

            // Cari produk berdasarkan ID
            $download = Download::findOrFail($id);

            // Update data produk di database
            $download->title = $validatedData['titleEdit'];
            $download->link = $validatedData['linkEdit'];
            $download->save();

            // Redirect kembali ke halaman admin dengan pesan sukses
            return redirect()->route('admin-downloads')->with('success', 'Download has been updated successfully!');
        } catch (ValidationException $e) {
            throw $e;
        } catch (Exception $e) {
            // Log error untuk debugging
            Log::error('Error updating download: ' . $e->getMessage());

            // Tampilkan pesan error ke user
            return redirect()->back()->with('error', 'An error occurred while updating the download. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Mencari produk berdasarkan ID
        $download = Download::findOrFail($id);

        // Menghapus produk dari database
        $download->delete();

        // Mengembalikan redirect dengan pesan sukses
        return redirect()->route('admin-downloads')->with('success', 'Download have been deleted successfully!');
    }
}
