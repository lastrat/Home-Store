<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable|string|max:20',
            'contact_address' => 'nullable|string|max:255',
            'site_name' => 'nullable|string|max:255',
            'site_description' => 'nullable|string|max:500',
            'payment_mobile_money_number' => 'nullable|string|max:20',
            'payment_virement_details' => 'nullable|string|max:500',
            'payment_boutique_details' => 'nullable|string|max:500',
        ]);

        foreach ($validated as $key => $value) {
            $group = match (true) {
                str_starts_with($key, 'contact_') => 'contact',
                str_starts_with($key, 'payment_') => 'payment',
                default => 'general',
            };
            SiteSetting::set($key, $value, 'string', $group, $key);
        }

        return redirect()->route('admin.settings.index')->with('success', 'Paramètres mis à jour avec succès.');
    }
}
