<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        // Get featured categories with cache
        $categories = Cache::remember('shop_categories', 3600, function () {
            return Category::withCount('products')->get();
        });

        // Base query
        $query = Product::query()
            ->with(['category'])
            ->where('is_active', true);

        // Featured products for the hero section
        $featuredProducts = Cache::remember('featured_products', 3600, function () {
            return Product::where('is_featured', true)
                         ->where('is_active', true)
                         ->with('category')
                         ->take(4)
                         ->get();
        });

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('category', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Price range filter
        if ($request->filled('price_range')) {
            list($min, $max) = explode('-', $request->price_range);
            if ($max > 0) {
                $query->whereBetween('price', [$min, $max]);
            } else {
                $query->where('price', '>=', $min);
            }
        }

        // Stock filter
        if ($request->filled('stock_status')) {
            if ($request->stock_status === 'in_stock') {
                $query->where('stock', '>', 0);
            } elseif ($request->stock_status === 'out_of_stock') {
                $query->where('stock', 0);
            }
        }

        // Sorting
        switch ($request->get('sort', 'newest')) {
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
            case 'popular':
                $query->withCount('orders')
                      ->orderBy('orders_count', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        // Get products with pagination
        $products = $query->paginate(12)->withQueryString();

        // Get price range for filters
        $priceRange = Cache::remember('product_price_range', 3600, function () {
            return [
                'min' => Product::where('is_active', true)->min('price'),
                'max' => Product::where('is_active', true)->max('price')
            ];
        });

        return view('pages.shop', compact(
            'products',
            'categories',
            'featuredProducts',
            'priceRange'
        ));
    }

    public function quickView($id)
    {
        $product = Product::with(['category'])->findOrFail($id);
        
        // Get related products
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)
            ->get();

        return response()->json([
            'success' => true,
            'html' => view('components.quick-view-product', compact('product', 'relatedProducts'))->render()
        ]);
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $quantity = $request->input('quantity', 1);

        if ($product->stock < $quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient stock available'
            ]);
        }

        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] + $quantity > $product->stock) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot add more items than available in stock'
                ]);
            }
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'quantity' => $quantity,
                'price' => $product->price,
                'image' => $product->image_url,
                'stock' => $product->stock
            ];
        }

        session()->put('cart', $cart);

        // Emit event untuk Livewire
        event(new \Illuminate\Support\Facades\Event('cartUpdated'));

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully',
            'cartCount' => array_sum(array_column($cart, 'quantity')),
            'cartData' => $cart
        ]);
    }

    public function toggleWishlist($id)
    {
        $wishlist = session()->get('wishlist', []);

        if (in_array($id, $wishlist)) {
            $wishlist = array_diff($wishlist, [$id]);
            $message = 'Product removed from wishlist';
        } else {
            $wishlist[] = $id;
            $message = 'Product added to wishlist';
        }

        session()->put('wishlist', $wishlist);

        return response()->json([
            'success' => true,
            'message' => $message,
            'isWishlisted' => in_array($id, $wishlist)
        ]);
    }
}
