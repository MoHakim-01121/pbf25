<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Method untuk menampilkan produk ke customer
    public function customerIndex(Request $request)
    {
        $query = Product::with('category')
                       ->where('is_active', true)
                       ->where('stock', '>', 0);

        // Filter berdasarkan pencarian
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan kategori
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        // Sorting
        $sort = $request->sort ?? 'latest';
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(10);
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    // Method untuk menampilkan detail produk ke customer
    public function show(Product $product)
    {
        if (!$product->is_active) {
            abort(404);
        }

        $relatedProducts = Product::where('category_id', $product->category_id)
                                 ->where('id', '!=', $product->id)
                                 ->where('is_active', true)
                                 ->where('stock', '>', 0)
                                 ->take(4)
                                 ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }

    // Menampilkan daftar produk dengan fitur pencarian dan pagination
    public function index(Request $request)
    {
        $keyword = substr($request->input('search'), 0, 100); // Batasi input pencarian max 100 karakter
        $category = $request->input('category');

        // Query produk dengan eager loading kategori
        $query = Product::with('category');

        // Filter berdasarkan nama produk atau nama kategori jika ada keyword
        if ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%')
                  ->orWhereHas('category', function ($q) use ($keyword) {
                      $q->where('name', 'like', '%' . $keyword . '%');
                  });
        }

        // Filter berdasarkan kategori jika ada
        if ($category) {
            $query->where('category_id', $category);
        }

        // Ambil produk dengan pagination 10 item per halaman, pertahankan query string untuk pagination links
        $products = $query->paginate(10)->appends($request->all());

        $categories = Category::all();        // Semua kategori untuk dropdown filter
        $totalProduk = Product::count();      // Total produk tanpa filter (opsional)

        return view('dashboard.products.index', compact('products', 'categories', 'totalProduk', 'keyword', 'category'));
    }

    // Menyimpan produk baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($data);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil ditambahkan.'
            ]);
        }

        return redirect()->route('dashboard.products.index')
                        ->with('success', 'Produk berhasil ditambahkan.');
    }

    // Menampilkan form edit produk
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('dashboard.products.edit', compact('product', 'categories'));
    }

    // API untuk mendapatkan data produk untuk edit
    public function getProductData($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    // Memperbarui data produk
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image && \Storage::disk('public')->exists($product->image)) {
                \Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil diperbarui.'
            ]);
        }

        return redirect()->route('dashboard.products.index')
                        ->with('success', 'Produk berhasil diperbarui.');
    }

    // Menghapus produk beserta gambarnya jika ada
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && \Storage::disk('public')->exists($product->image)) {
            \Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil dihapus.'
            ]);
        }

        return redirect()->route('dashboard.products.index')
                        ->with('success', 'Produk berhasil dihapus.');
    }
}
