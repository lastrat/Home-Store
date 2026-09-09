<?php

namespace App\Http\Controllers;

use App\Models\HeroSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminHeroSlideController extends Controller
{
    public function index()
    {
        $slides = HeroSlide::ordered()->get();
        return view('admin.hero_slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.hero_slides.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'background_image' => 'required|image|max:4096',
            'badge_text' => 'nullable|string|max:100',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|url|max:500',
            'type' => 'required|in:mode,decoration,general',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('background_image')) {
            $validated['background_image'] = $request->file('background_image')->store('hero-slides', 'public');
        }

        $validated['order'] = $request->input('order', 0);
        $validated['is_active'] = $request->boolean('is_active');

        HeroSlide::create($validated);

        return redirect()->route('admin.hero_slides.index')->with('success', 'Slide créé avec succès.');
    }

    public function edit(HeroSlide $hero_slide)
    {
        return view('admin.hero_slides.edit', compact('hero_slide'));
    }

    public function update(Request $request, HeroSlide $hero_slide)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'background_image' => 'nullable|image|max:4096',
            'badge_text' => 'nullable|string|max:100',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|url|max:500',
            'type' => 'required|in:mode,decoration,general',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('background_image')) {
            if ($hero_slide->background_image) {
                Storage::disk('public')->delete($hero_slide->background_image);
            }
            $validated['background_image'] = $request->file('background_image')->store('hero-slides', 'public');
        }

        $validated['order'] = $request->input('order', $hero_slide->order);
        $validated['is_active'] = $request->boolean('is_active');

        $hero_slide->update($validated);

        return redirect()->route('admin.hero_slides.index')->with('success', 'Slide mis à jour avec succès.');
    }

    public function destroy(HeroSlide $hero_slide)
    {
        if ($hero_slide->background_image) {
            Storage::disk('public')->delete($hero_slide->background_image);
        }

        $hero_slide->delete();

        return back()->with('success', 'Slide supprimé avec succès.');
    }
}
