<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['brand', 'category'])
            ->where('is_active', true);

        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        if ($request->filled('brand')) {
            $query->where('brand_id', $request->brand);
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('color')) {
            $query->where('color', 'like', '%' . $request->color . '%');
        }

        if ($request->filled('min_price')) {
            $query->whereRaw('COALESCE(sale_price, price) >= ?', [(float) $request->min_price]);
        }

        if ($request->filled('max_price')) {
            $query->whereRaw('COALESCE(sale_price, price) <= ?', [(float) $request->max_price]);
        }

        if ($request->filled('max_speed')) {
            $query->where('max_speed', '>=', (int) $request->max_speed);
        }

        if ($request->filled('range_per_charge')) {
            $query->where('range_per_charge', '>=', (int) $request->range_per_charge);
        }

        switch ($request->sort) {
            case 'price_asc':
                $query->orderByRaw('COALESCE(sale_price, price) ASC');
                break;
            case 'price_desc':
                $query->orderByRaw('COALESCE(sale_price, price) DESC');
                break;
            case 'newest':
                $query->latest();
                break;
            case 'best_seller':
                $query->orderByDesc('sold_count');
                break;
            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(12)->withQueryString();
        $brands = Brand::where('is_active', true)->orderBy('name')->get();
        $categories = Category::where('is_active', true)->orderBy('name')->get();

        return view('user.products.index', compact('products', 'brands', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::with([
            'brand',
            'category',
            'images',
            'reviews' => function ($query) {
                $query->where('is_approved', true)->latest();
            },
            'reviews.user',
        ])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('user.products.show', compact('product'));
    }

    public function search(Request $request)
    {
        return redirect()->route('products.index', [
            'q' => $request->q,
        ]);
    }
}
