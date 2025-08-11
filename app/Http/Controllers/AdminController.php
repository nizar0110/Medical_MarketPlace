<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function dashboard()
    {
        // Statistiques générales
        $usersCount = User::count();
        $productsCount = Product::count();
        $ordersCount = Order::count();
        $revenue = Order::where('status', 'completed')->sum('total');

        // Statistiques mensuelles
        $startOfMonth = Carbon::now()->startOfMonth();
        $monthlyOrders = Order::where('created_at', '>=', $startOfMonth)->count();
        $monthlyRevenue = Order::where('created_at', '>=', $startOfMonth)
            ->where('status', 'completed')
            ->sum('total');
        $monthlyUsers = User::where('created_at', '>=', $startOfMonth)->count();

        // Utilisateurs récents
        $recentUsers = User::latest()
            ->take(5)
            ->get();

        // Commandes récentes
        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        // Statistiques des ventes par catégorie
        $salesByCategory = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.name', DB::raw('SUM(order_items.quantity * order_items.price) as total'))
            ->where('orders.status', 'completed')
            ->groupBy('categories.id', 'categories.name')
            ->get();

        // Statistiques des produits les plus vendus
        $topProducts = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select('products.name', DB::raw('SUM(order_items.quantity) as total_sold'))
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'usersCount',
            'productsCount',
            'ordersCount',
            'revenue',
            'monthlyOrders',
            'monthlyRevenue',
            'monthlyUsers',
            'recentUsers',
            'recentOrders',
            'salesByCategory',
            'topProducts'
        ));
    }

    /**
     * Update dashboard layout preferences.
     */
    public function updateDashboardLayout(Request $request)
    {
        $user = auth()->user();
        $user->dashboard_preferences = $request->layout;
        $user->save();

        return response()->json(['message' => 'Layout updated successfully']);
    }

    /**
     * Get dashboard statistics for a specific time period.
     */
    public function getStatistics(Request $request)
    {
        $period = $request->period ?? 'month'; // day, week, month, year
        $start = Carbon::now();

        switch ($period) {
            case 'day':
                $start = $start->startOfDay();
                break;
            case 'week':
                $start = $start->startOfWeek();
                break;
            case 'month':
                $start = $start->startOfMonth();
                break;
            case 'year':
                $start = $start->startOfYear();
                break;
        }

        $stats = [
            'orders' => Order::where('created_at', '>=', $start)->count(),
            'revenue' => Order::where('created_at', '>=', $start)
                ->where('status', 'completed')
                ->sum('total'),
            'users' => User::where('created_at', '>=', $start)->count(),
            'products' => Product::where('created_at', '>=', $start)->count(),
        ];

        return response()->json($stats);
    }
}
