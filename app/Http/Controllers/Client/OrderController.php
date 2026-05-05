<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderItem;

class OrderController extends Controller
{
    /**
     * 📦 Liste des commandes du client
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
                        ->latest()
                        ->get();

        return view('client.orders', compact('orders'));
    }

    /**
     * 🛒 Créer une commande depuis le panier
     */
    public function store()
    {
        $user = Auth::user();

        // Récupérer les articles du panier
        $cartItems = Cart::where('user_id', $user->id)->get();

        // Vérifier si panier vide
        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Votre panier est vide 🛒');
        }

        // Créer la commande
        $order = Order::create([
            'user_id' => $user->id,
            'total' => 0,
            'status' => 'pending'
        ]);

        $total = 0;

        // Ajouter les produits à la commande
        foreach ($cartItems as $item) {
            $price = $item->product->price;

            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $price,
            ]);

            $total += $price * $item->quantity;
        }

        // Mettre à jour le total
        $order->update([
            'total' => $total
        ]);

        // Vider le panier
        Cart::where('user_id', $user->id)->delete();

        return redirect()
            ->route('client.orders.index')
            ->with('success', 'Commande passée avec succès 🎉');
    }

    /**
     * 🔍 Voir une commande
     */
    public function show(Order $order)
    {
        // sécurité : vérifier que la commande appartient au user
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // charger les produits
        $order->load('items.product');

        return view('client.orders.show', compact('order'));
    }

    public function cancel(Order $order)
{
    // sécurité : vérifier que la commande appartient au client
    if ($order->user_id !== auth()->id()) {
        abort(403);
    }

    // empêcher d’annuler si déjà livrée
    if ($order->status === 'delivered') {
        return back()->with('error', 'Impossible d’annuler une commande déjà livrée');
    }

    // mettre à jour le statut
    $order->update([
        'status' => 'cancelled'
    ]);

    return back()->with('success', 'Commande annulée avec succès ❌');
}

public function destroy(Order $order)
{
    // sécurité
    if ($order->user_id !== auth()->id()) {
        abort(403);
    }

    // empêcher suppression si déjà livrée
    if ($order->status == 'completed') {
        return back()->with('error', 'Impossible de supprimer une commande livrée');
    }

    // supprimer les items liés (important)
    $order->items()->delete();

    // supprimer la commande
    $order->delete();

    return back()->with('success', 'Commande supprimée avec succès 🗑️');
}



}
