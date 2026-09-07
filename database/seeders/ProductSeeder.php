<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'Robe élégante noir', 'category' => 'Robes', 'price' => 25000, 'stock' => 5, 'badge' => 'nouveau', 'size' => 'M', 'color' => 'Noir', 'material' => 'Coton'],
            ['name' => 'Ensemble wax coloré', 'category' => 'Ensembles', 'price' => 35000, 'stock' => 3, 'badge' => 'coup_de_coeur', 'size' => 'L', 'color' => 'Multicolore', 'material' => 'Wax'],
            ['name' => 'Sac à main cuir', 'category' => 'Sacs', 'price' => 18000, 'stock' => 8, 'size' => 'Unique', 'color' => 'Marron', 'material' => 'Cuir'],
            ['name' => ' Collier doré', 'category' => 'Accessoires', 'price' => 12000, 'stock' => 15, 'size' => 'Unique', 'color' => 'Or', 'material' => 'Métal'],
            ['name' => 'Lampe de salon design', 'category' => 'Luminaires', 'price' => 45000, 'stock' => 2, 'badge' => 'nouveau', 'size' => 'M', 'color' => 'Blanc', 'material' => 'Métal'],
            ['name' => 'Vase céramique blanc', 'category' => 'Vases', 'price' => 15000, 'stock' => 10, 'size' => 'L', 'color' => 'Blanc', 'material' => 'Céramique'],
            ['name' => 'Coussin velours doré', 'category' => 'Coussins', 'price' => 8500, 'stock' => 20, 'size' => 'L', 'color' => 'Or', 'material' => 'Velours'],
            ['name' => 'Canapé 3 places', 'category' => 'Salon', 'price' => 250000, 'stock' => 1, 'size' => 'XL', 'color' => 'Gris', 'material' => 'Lin'],
        ];

        foreach ($products as $productData) {
            $category = Category::where('name', $productData['category'])->first();
            Product::create([
                'category_id' => $category->id,
                'name' => $productData['name'],
                'slug' => Str::slug($productData['name']),
                'description' => 'Un produit ' . $productData['name'] . ' de qualité supérieure, parfait pour sublimer votre style.',
                'characteristics' => 'Taille: ' . $productData['size'] . ', Couleur: ' . $productData['color'] . ', Matière: ' . $productData['material'],
                'price' => $productData['price'],
                'stock' => $productData['stock'],
                'badge' => $productData['badge'] ?? null,
                'is_active' => true,
                'is_featured' => true,
                'size' => $productData['size'],
                'color' => $productData['color'],
                'material' => $productData['material'],
            ]);
        }
    }
}
