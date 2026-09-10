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
        ]);

        foreach ($validated as $key => $value) {
            SiteSetting::set($key, $value, 'string', 'contact', $key);
        }

        return redirect()->route('admin.settings.index')->with('success', 'Paramètres mis à jour avec succès.');
    }
}
