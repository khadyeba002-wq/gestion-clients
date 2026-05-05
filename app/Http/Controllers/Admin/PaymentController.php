<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class PaymentController extends Controller
{
    /**
     * 📄 Liste des paiements
     */
    public function index()
    {
        $payments = Payment::with(['order.user']) // 🔥 relations optimisées
            ->latest()
            ->paginate(10);

        return view('admin.payments.index', compact('payments'));
    }
}
