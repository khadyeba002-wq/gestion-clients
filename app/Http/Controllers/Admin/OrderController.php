<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // 📦 Liste des commandes
    public function index()
    {
        $orders = Order::with('user')->latest()->get();

        return view('admin.orders.index', compact('orders'));
    }

    // 🔍 Voir une commande (✅ CORRIGÉ)
    public function show(Order $order)
    {
        // 🔥 charger toutes les relations
        $order->load('user', 'items.product');

        return view('admin.orders.show', compact('order'));
    }

    // 🔄 Changer statut
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Statut mis à jour ✅');
    }
}
