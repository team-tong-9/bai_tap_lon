<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalUsers = User::count();
        $totalRevenue = Order::where('status', 'completed')->sum('total_amount');
        $recentOrders = Order::with('user')->orderBy('id', 'desc')->limit(5)->get();
        $lowStockProducts = Product::where('stock', '<', 5)->get();

        return view('admin.dashboard', compact(
            'totalProducts', 'totalOrders', 'totalUsers',
            'totalRevenue', 'recentOrders', 'lowStockProducts'
        ));
    }
}
