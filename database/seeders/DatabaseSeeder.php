<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CitySeeder::class,
            CategorySeeder::class,
            NeighborhoodSeeder::class,
            AdminUserSeeder::class,
            ProductSeeder::class,
            HeroSlideSeeder::class,
            SiteSettingSeeder::class,
        ]);
    }
}
