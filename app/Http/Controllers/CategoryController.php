<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::create(['name' => $request->name]);
        try {
            Http::post('http://localhost:5678/webhook/laporan-toko', [
                'aksi' => 'Tambah Kategori',
                'nama_barang' => $request->name, // Kita pinjam kolom nama_barang
                'harga' => '-', // Strip karena kategori gratis
                'admin' => Auth::user()->name,
                'waktu' => now()->format('Y-m-d H:i:s')
            ]);
        } catch (\Exception $e) {
        }
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return response()->json(['data' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(['name' => 'required|max:255']);
        $category = Category::findOrFail($id);
        $category->update(['name' => $request->name]);

        try {
            Http::post('http://localhost:5678/webhook/laporan-toko', [
                'aksi' => 'Edit Kategori',
                'nama_barang' => $request->name . ' (Diedit)',
                'harga' => '-',
                'admin' => Auth::user()->name,
                'waktu' => now()->format('Y-m-d H:i:s')
            ]);
        } catch (\Exception $e) {
        }
        return redirect()->route('categories.index')->with('warning', 'Kategori berhasil dterbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        try {
            Http::post('http://localhost:5678/webhook/laporan-toko', [
                'aksi' => 'Hapus Kategori',
                'nama_barang' => $namaLama,
                'harga' => '-',
                'admin' => Auth::user()->name,
                'waktu' => now()->format('Y-m-d H:i:s')
            ]);
        } catch (\Exception $e) {
        }
        return redirect()->route('categories.index')->with('danger', 'Kategori berhasil dihapus');
    }
}
