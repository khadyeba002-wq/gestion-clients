<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Product;
use App\Models\Cart;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $orders = Order::where('user_id', $user->id);

        // ✅ produits pour affichage
        $products = Product::latest()->take(6)->get();

        // ✅ panier
        $cartCount = Cart::where('user_id', $user->id)->count();

        return view('client.dashboard', [
            'ordersCount' => $orders->count(),
            'totalSpent' => $orders->sum('total'),
            'products' => $products,
            'cartCount' => $cartCount,
        ]);
    }
}
