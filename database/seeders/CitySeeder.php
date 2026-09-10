<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            ['name' => 'Yaoundé', 'region' => 'Centre', 'order' => 1],
            ['name' => 'Douala', 'region' => 'Littoral', 'order' => 2],
            ['name' => 'Bafoussam', 'region' => 'Ouest', 'order' => 3],
            ['name' => 'Garoua', 'region' => 'Nord', 'order' => 4],
            ['name' => 'Bamenda', 'region' => 'Nord-Ouest', 'order' => 5],
            ['name' => 'Maroua', 'region' => 'Extrême-Nord', 'order' => 6],
            ['name' => 'Ngaoundéré', 'region' => 'Adamaoua', 'order' => 7],
            ['name' => 'Bertoua', 'region' => 'Est', 'order' => 8],
            ['name' => 'Buea', 'region' => 'Sud-Ouest', 'order' => 9],
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
