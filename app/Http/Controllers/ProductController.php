<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('products.index', compact('products'));



        // 2. Kirim variabel $products ke view menggunakan compact
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. VALIDASI (Wajib Paling Atas)
        // Cek dulu apakah datanya benar sebelum melakukan apapun
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        // 2. SANITASI (Bersihkan Data)
        // Hapus script berbahaya dari nama produk
        $cleanName = strip_tags($request->name);

        // 3. SIMPAN KE DATABASE (Cukup 1 kali saja!)
        Product::create([
            'name' => $cleanName, // KITA PAKAI NAMA BERSIH DI SINI
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);

        // 4. LOGIKA N8N (Otomatisasi)
        try {
            Http::post('http://localhost:5678/webhook/laporan-toko', [
                'aksi' => 'Input Barang Baru',
                'nama_barang' => $cleanName, // Kirim nama bersih ke Telegram juga
                'harga' => $request->price,
                'admin' => Auth::user()->name,
                'waktu' => now()->format('Y-m-d H:i:s')
            ]);
        } catch (\Exception $e) {
            // Diamkan error n8n
        }

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with('category')->findOrFail($id); // TYPO FIXED: $prodcut -> $product
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // TYPO FIXED: $procut -> $product
        // Variabel ini HARUS bernama $product karena dipanggil di compact('product')
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->only(['name', 'description', 'price', 'category_id']));

        try {
            Http::post('http://localhost:5678/webhook/laporan-toko', [
                'aksi' => 'Edit Barang', // Penanda aksi
                'nama_barang' => $product->name . ' (Diedit)',
                'harga' => $product->price,
                'admin' => Auth::user()->name,
                'waktu' => now()->format('Y-m-d H:i:s')
            ]);
        } catch (\Exception $e) {
        }

        return redirect()->route('products.index')->with('warning', 'Produk berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // TYPO FIXED: deletae() -> delete()
        $product->delete();


        return redirect()->route('products.index')->with('danger', 'Produk berhasil dihapus');
    }
}
