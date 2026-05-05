<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('client.checkout');
    }

  public function process(Request $request)
{
    Order::create([
        'user_id' => auth()->id(),
        'total' => 71000,
        'status' => 'en attente' // ⚠️ pas payé directement
    ]);

    return redirect()->route('client.dashboard')
        ->with('success', 'Commande envoyée. Veuillez effectuer le paiement.');
}

}
