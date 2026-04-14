<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalUsers = User::where('role', 'user')->count();
        $revenue = Order::where('status', 'completed')->sum('total_amount');

        $monthlyOrders = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'month')
            ->toArray();

        $chartLabels = [];
        $chartData = [];

        for ($month = 1; $month <= 12; $month++) {
            $chartLabels[] = 'T' . $month;
            $chartData[] = $monthlyOrders[$month] ?? 0;
        }

        $latestOrders = Order::latest()->take(5)->get();
        $lowStockProducts = Product::where('quantity', '<=', 5)
            ->orderBy('quantity')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalUsers',
            'revenue',
            'chartLabels',
            'chartData',
            'latestOrders',
            'lowStockProducts'
        ));
    }
}
