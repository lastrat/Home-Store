<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->latest()->paginate(20);
        $categories = Category::orderBy('name')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)
            ->whereNull('parent_id')
            ->with('children')
            ->orderBy('name')
            ->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'characteristics' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'size' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:100',
            'material' => 'nullable|string|max:100',
            'image1' => 'nullable|image|max:2048',
            'image2' => 'nullable|image|max:2048',
            'image3' => 'nullable|image|max:2048',
            'video_url' => 'nullable|url',
            'badge' => 'nullable|in:nouveau,coup_de_coeur,bientot_epuise',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'variants' => 'nullable|array',
            'variants.*.size' => 'nullable|string|max:50',
            'variants.*.color' => 'nullable|string|max:100',
            'variants.*.material' => 'nullable|string|max:100',
            'variants.*.sku' => 'nullable|string|max:100',
            'variants.*.stock' => 'nullable|integer|min:0',
            'variants.*.price_adjustment' => 'nullable|numeric|min:0',
        ]);

        if ($request->hasFile('image1')) {
            $validated['image1'] = $request->file('image1')->store('products', 'public');
        }
        if ($request->hasFile('image2')) {
            $validated['image2'] = $request->file('image2')->store('products', 'public');
        }
        if ($request->hasFile('image3')) {
            $validated['image3'] = $request->file('image3')->store('products', 'public');
        }

        $validated['slug'] = \Illuminate\Support\Str::slug($request->name);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');

        $product = Product::create($validated);

        if ($request->has('variants')) {
            foreach ($request->variants as $variantData) {
                if ($variantData['stock'] > 0) {
                    $product->variants()->create($variantData);
                }
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Produit créé.');
    }

    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)
            ->whereNull('parent_id')
            ->with('children')
            ->orderBy('name')
            ->get();
        $product->load('variants');
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'characteristics' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'size' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:100',
            'material' => 'nullable|string|max:100',
            'image1' => 'nullable|image|max:2048',
            'image2' => 'nullable|image|max:2048',
            'image3' => 'nullable|image|max:2048',
            'video_url' => 'nullable|url',
            'badge' => 'nullable|in:nouveau,coup_de_coeur,bientot_epuise',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'variants' => 'nullable|array',
            'variants.*.id' => 'nullable|exists:product_variants,id',
            'variants.*.size' => 'nullable|string|max:50',
            'variants.*.color' => 'nullable|string|max:100',
            'variants.*.material' => 'nullable|string|max:100',
            'variants.*.sku' => 'nullable|string|max:100',
            'variants.*.stock' => 'nullable|integer|min:0',
            'variants.*.price_adjustment' => 'nullable|numeric|min:0',
        ]);

        if ($request->hasFile('image1')) {
            if ($product->image1) {
                Storage::disk('public')->delete($product->image1);
            }
            $validated['image1'] = $request->file('image1')->store('products', 'public');
        }
        if ($request->hasFile('image2')) {
            if ($product->image2) {
                Storage::disk('public')->delete($product->image2);
            }
            $validated['image2'] = $request->file('image2')->store('products', 'public');
        }
        if ($request->hasFile('image3')) {
            if ($product->image3) {
                Storage::disk('public')->delete($product->image3);
            }
            $validated['image3'] = $request->file('image3')->store('products', 'public');
        }

        $validated['slug'] = \Illuminate\Support\Str::slug($request->name);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');

        $product->update($validated);

        if ($request->has('variants')) {
            $existingIds = [];
            $toDelete = [];
            foreach ($request->variants as $variantData) {
                if ($variantData['id'] ?? null) {
                    if ($variantData['id'] === '__DELETE__') {
                        continue;
                    }
                    $variant = ProductVariant::where('id', $variantData['id'])
                        ->where('product_id', $product->id)
                        ->first();

                    if ($variant) {
                        $variant->update($variantData);
                        $existingIds[] = $variant->id;
                    }
                } else {
                    if (!empty($variantData['size']) || !empty($variantData['color']) || !empty($variantData['material']) || !empty($variantData['stock'])) {
                        $newVariant = $product->variants()->create($variantData);
                        $existingIds[] = $newVariant->id;
                    }
                }
            }

            $product->variants()->whereNotIn('id', $existingIds)->delete();
        } else {
            $product->variants()->delete();
        }

        return redirect()->route('admin.products.index')->with('success', 'Produit mis à jour.');
    }

    public function destroy(Product $product)
    {
        if ($product->image1) {
            Storage::disk('public')->delete($product->image1);
        }
        if ($product->image2) {
            Storage::disk('public')->delete($product->image2);
        }
        if ($product->image3) {
            Storage::disk('public')->delete($product->image3);
        }

        $product->delete();

        return back()->with('success', 'Produit supprimé.');
    }
}
