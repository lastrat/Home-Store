<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $families = [
            'mode' => [
                'Robes', 'Ensembles', 'Sacs', 'Accessoires', 'Chaussures',
            ],
            'decoration' => [
                'Salon', 'Luminaires', 'Vases', 'Coussins', 'Mobilier',
            ],
        ];

        foreach ($families as $family => $names) {
            $parent = Category::firstOrCreate(
                ['slug' => $family],
                ['name' => ucfirst($family), 'family' => $family, 'is_active' => true]
            );

            foreach ($names as $name) {
                Category::firstOrCreate(
                    ['slug' => Str::slug($name)],
                    ['name' => $name, 'family' => $family, 'parent_id' => $parent->id, 'is_active' => true]
                );
            }
        }
    }
}
