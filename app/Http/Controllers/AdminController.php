<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Menampilkan halaman dashboard
    public function index()
    {
        // Menyediakan data untuk dashboard, misalnya jumlah produk dan pengguna
        $totalProducts = Product::count();
        $totalUsers = User::count();
        $totalTransactions = 0; // Bisa diisi dengan query yang sesuai jika ada transaksi

        // Mengirimkan data ke tampilan dashboard
        return view('dashboard.index', compact('totalProducts', 'totalUsers', 'totalTransactions'));
    }

    // Menampilkan daftar produk
    public function showProducts()
    {
        $products = Product::all();
        return view('dashboard.products.index', compact('products'));
    }

    // Menampilkan form untuk menambah produk
    public function createProduct()
    {
        return view('dashboard.products.create');
    }

    // Menampilkan form untuk mengedit produk
    public function editProduct(Product $product)
    {
        return view('dashboard.products.edit', compact('product'));
    }

    // Mengupdate produk
    public function updateProduct(Request $request, Product $product)
    {
        // Validasi inputan dan update produk
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $product->update($request->all());

        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->save();

        return redirect()->route('dashboard.products.index');
    }

    // Menghapus produk
    public function destroyProduct(Product $product)
    {
        $product->delete();
        return redirect()->route('dashboard.products.index');
    }
}
