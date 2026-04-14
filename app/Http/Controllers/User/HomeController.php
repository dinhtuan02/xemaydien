<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Banner;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::where('is_active', true)
            ->orderBy('position')
            ->get();

        $featuredProducts = Product::with('brand')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->take(8)
            ->get();

        $newProducts = Product::with('brand')
            ->where('is_active', true)
            ->where('is_new', true)
            ->latest()
            ->take(8)
            ->get();

        $saleProducts = Product::with('brand')
            ->where('is_active', true)
            ->where('is_sale', true)
            ->latest()
            ->take(8)
            ->get();

        return view('user.home', compact(
            'banners',
            'featuredProducts',
            'newProducts',
            'saleProducts'
        ));
    }
}
