<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            ['name' => 'Douala', 'region' => 'Littoral', 'order' => 1],
            ['name' => 'Yaoundé', 'region' => 'Centre', 'order' => 2],
            ['name' => 'Bafoussam', 'region' => 'Ouest', 'order' => 3],
            ['name' => 'Bamenda', 'region' => 'Nord-Ouest', 'order' => 4],
            ['name' => 'Kribi', 'region' => 'Sud', 'order' => 5],
            ['name' => 'Limbe', 'region' => 'Sud-Ouest', 'order' => 6],
            ['name' => 'Buea', 'region' => 'Sud-Ouest', 'order' => 7],
            ['name' => 'Garoua', 'region' => 'Nord', 'order' => 8],
            ['name' => 'Maroua', 'region' => 'Extrême-Nord', 'order' => 9],
            ['name' => 'Ngaoundéré', 'region' => 'Adamaoua', 'order' => 10],
            ['name' => 'Ebolowa', 'region' => 'Sud', 'order' => 11],
            ['name' => 'Dschang', 'region' => 'Ouest', 'order' => 12],
            ['name' => 'Bafang', 'region' => 'Ouest', 'order' => 13],
            ['name' => 'Foumban', 'region' => 'Ouest', 'order' => 14],
            ['name' => 'Kumba', 'region' => 'Sud-Ouest', 'order' => 15],
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
