<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // 🧠 DASHBOARD
    public function index()
    {
        $today     = Carbon::today();
        $thisMonth = Carbon::now()->startOfMonth();
        $lastMonth = Carbon::now()->subMonth()->startOfMonth();

        // 💰 KPI JOUR
        $revenueToday = Order::whereDate('created_at', $today)
            ->where('status', '!=', 'cancelled')
            ->sum('total');

        $ordersToday = Order::whereDate('created_at', $today)->count();

        $newClientsToday = User::whereDate('created_at', $today)
            ->where('role', '!=', 'admin')
            ->count();

        // 📦 PRODUITS
        $productsCount = Product::where('stock', '>', 0)->count();

        $productsPrev = Product::where('stock', '>', 0)
            ->where('created_at', '<', $thisMonth)
            ->count();

        // 📦 COMMANDES
        $ordersMonth = Order::where('created_at', '>=', $thisMonth)->count();

        $ordersLast = Order::whereBetween('created_at', [$lastMonth, $thisMonth])->count();

        // 👥 CLIENTS
        $clientsCount = User::where('role', '!=', 'admin')->count();

        $clientsPrev = User::where('role', '!=', 'admin')
            ->where('created_at', '<', $thisMonth)
            ->count();

        // 💰 REVENUS
        $revenueMonth = Order::where('created_at', '>=', $thisMonth)
            ->where('status', '!=', 'cancelled')
            ->sum('total');

        $revenueLast = Order::whereBetween('created_at', [$lastMonth, $thisMonth])
            ->where('status', '!=', 'cancelled')
            ->sum('total');

        // 📊 TRENDS
        $productsTrend = $this->trend($productsCount, $productsPrev);
        $ordersTrend   = $this->trend($ordersMonth, $ordersLast);
        $clientsTrend  = $this->trend($clientsCount, $clientsPrev);
        $revenueTrend  = $this->trend($revenueMonth, $revenueLast);

        // 🔔 COMMANDES EN ATTENTE
        $pendingOrders = Order::whereIn('status', ['pending', 'processing'])->count();

        // 🧾 DERNIÈRES COMMANDES (✅ CORRIGÉ ICI)
        $latestOrders = Order::with(['user', 'items.product'])
            ->latest()
            ->limit(5)
            ->get();

        // 🏆 TOP PRODUITS
        $topProducts = Product::withCount('orderItems as sales_count')
            ->withSum('orderItems as total_revenue', DB::raw('order_items.quantity * order_items.price'))
            ->orderByDesc('sales_count')
            ->limit(5)
            ->get();

        // 📈 MINI CHART
        $weeklyOrders = collect(range(6, 0))->map(fn($daysAgo) =>
            Order::whereDate('created_at', $today->copy()->subDays($daysAgo))->count()
        )->toArray();

        return view('admin.dashboard', compact(
            'revenueToday',
            'ordersToday',
            'newClientsToday',
            'productsCount',
            'productsTrend',
            'ordersMonth',
            'ordersTrend',
            'clientsCount',
            'clientsTrend',
            'revenueMonth',
            'revenueTrend',
            'pendingOrders',
            'latestOrders',
            'topProducts',
            'weeklyOrders'
        ));
    }

    // 📊 STATS
    public function stats()
    {
        return view('admin.stats.index');
    }

    // 📈 HELPER TREND
    private function trend($current, $previous)
    {
        return $previous > 0
            ? round((($current - $previous) / $previous) * 100)
            : 0;
    }
}
