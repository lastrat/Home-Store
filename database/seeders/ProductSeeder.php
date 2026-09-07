<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Neighborhood;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Robes', 'family' => 'mode'],
            ['name' => 'Ensembles', 'family' => 'mode'],
            ['name' => 'Sacs', 'family' => 'mode'],
            ['name' => 'Accessoires', 'family' => 'mode'],
            ['name' => 'Salon', 'family' => 'decoration'],
            ['name' => 'Luminaires', 'family' => 'decoration'],
            ['name' => 'Vases', 'family' => 'decoration'],
            ['name' => 'Coussins', 'family' => 'decoration'],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(['slug' => \Illuminate\Support\Str::slug($cat['name'])], $cat + ['is_active' => true]);
        }

        $products = [
            ['name' => 'Robe élégante noir', 'category' => 'Robes', 'price' => 25000, 'stock' => 5, 'badge' => 'nouveau'],
            ['name' => 'Ensemble wax coloré', 'category' => 'Ensembles', 'price' => 35000, 'stock' => 3, 'badge' => 'coup_de_coeur'],
            ['name' => 'Sac à main cuir', 'category' => 'Sacs', 'price' => 18000, 'stock' => 8],
            ['name' => ' Collier doré', 'category' => 'Accessoires', 'price' => 12000, 'stock' => 15],
            ['name' => 'Lampe de salon design', 'category' => 'Luminaires', 'price' => 45000, 'stock' => 2, 'badge' => 'nouveau'],
            ['name' => 'Vase céramique blanc', 'category' => 'Vases', 'price' => 15000, 'stock' => 10],
            ['name' => 'Coussin velours doré', 'category' => 'Coussins', 'price' => 8500, 'stock' => 20],
            ['name' => 'Canapé 3 places', 'category' => 'Salon', 'price' => 250000, 'stock' => 1],
        ];

        foreach ($products as $productData) {
            $category = Category::where('name', $productData['category'])->first();
            Product::create([
                'category_id' => $category->id,
                'name' => $productData['name'],
                'slug' => \Illuminate\Support\Str::slug($productData['name']),
                'description' => 'Un produit ' . $productData['name'] . ' de qualité supérieure, parfait pour sublimer votre style.',
                'characteristics' => 'Matière: Premium, Couleur: Disponible en plusieurs teintes',
                'price' => $productData['price'],
                'stock' => $productData['stock'],
                'badge' => $productData['badge'] ?? null,
                'is_active' => true,
                'is_featured' => true,
            ]);
        }
    }
}
