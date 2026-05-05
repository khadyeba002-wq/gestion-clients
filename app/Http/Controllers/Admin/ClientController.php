<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class ClientController extends Controller
{
    /**
     * 📋 Liste des clients
     */
   public function index()
{
    $clients = User::where('role', '!=', 'admin')
        ->withCount('orders') // 🔥 IMPORTANT
        ->latest()
        ->paginate(10);

    return view('admin.clients.index', compact('clients'));
}

    /**
     * 👤 Détail client
     */
    public function show(User $user)
    {
        return view('admin.clients.show', compact('user'));
    }
}
