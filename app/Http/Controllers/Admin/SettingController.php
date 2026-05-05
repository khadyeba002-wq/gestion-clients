<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * ⚙️ Affichage des paramètres
     */
    public function index()
    {
        $setting = Setting::first();

        return view('admin.settings.index', compact('setting'));
    }

    /**
     * 🔄 Mise à jour des paramètres
     */
    public function update(Request $request)
{
    // ✅ Validation complète
    $data = $request->validate([
        'app_name'       => 'required|string|max:255',
        'email'          => 'nullable|email',
        'phone'          => 'nullable|string|max:20',
        'address'        => 'nullable|string|max:255',
        'description'    => 'nullable|string|max:255',
        'currency'       => 'nullable|string|max:10',

        // 💳 NOUVEAUX CHAMPS
        'wave_number'    => 'nullable|string|max:20',
        'orange_number'  => 'nullable|string|max:20',
    ]);

    // ✅ récupérer ou créer UNE SEULE FOIS
    $setting = Setting::firstOrCreate([]);

    // ✅ update propre
    $setting->update($data);

    return back()->with('success', 'Paramètres mis à jour ✅');
}
}
