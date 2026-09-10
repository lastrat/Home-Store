<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Neighborhood;
use Illuminate\Database\Seeder;

class NeighborhoodSeeder extends Seeder
{
    public function run(): void
    {
        $neighborhoodsByCity = [
            'Douala' => [
                'Cocody', 'Plateau', 'Marcory', 'Yopougon', 'Adjamé',
                'Treichville', 'Koumassi', 'Port-Bouët', 'Abobo', 'Attécoubé',
                'Bingerville', 'Anyama', 'Songon', 'Brofodoumé'
            ],
            'Yaoundé' => [
                'Bastos', 'Essos', 'Mvan', 'Nlongkak', 'Tam-Tam',
                'Emana', 'Odza', 'Ekounou', 'Nkolbisson', 'Mfoundi'
            ],
            'Bafoussam' => [
                'Banengo', 'Djeleng', 'Kouogouo', 'Nouvelle Route', 'Ville',
                'Marché', 'Goulfok', 'Tamdja', 'Bamendzi', 'Mambain'
            ],
            'Bamenda' => [
                'Commercial Avenue', 'Ntambeng', 'Mile 1', 'Mile 2', 'Mile 3',
                'Mile 4', 'Bamenda Town', 'Nkwen', 'Bafut', 'Mambanda'
            ],
            'Kribi' => [
                'Centre Ville', 'Plage', 'Kribi Ville', 'Mengong', 'Ngoye'
            ],
            'Limbe' => [
                'Limbe Ville', 'Bota', 'Mundemba', 'Idenau', 'Meme'
            ],
            'Buea' => [
                'Buea Town', 'Molyko', 'Bakinge', 'Great Soppo', 'Small Soppo'
            ],
            'Garoua' => [
                'Centre Ville', 'Garoua Ville', 'Marché Central', 'Rural', 'Sakkara'
            ],
            'Maroua' => [
                'Centre Ville', 'Maroua Ville', 'Diamaré', 'Kansé', 'Mokolo'
            ],
            'Ngaoundéré' => [
                'Centre Ville', 'Ngaoundéré Ville', 'Mayo-Baléo', 'Demsa', 'Vina'
            ],
            'Ebolowa' => [
                'Centre Ville', 'Ebolowa Ville', 'Mvangan', 'Bipindi', 'Meyomessala'
            ],
            'Dschang' => [
                'Centre Ville', 'Dschang Ville', 'Marché', 'Kékem', 'Santchou'
            ],
            'Bafang' => [
                'Centre Ville', 'Bafang Ville', 'Marché Central', 'Bakou', 'Mbang'
            ],
            'Foumban' => [
                'Centre Ville', 'Foumban Ville', 'Marché', 'Foumban Nord', 'Foumban Sud'
            ],
            'Kumba' => [
                'Centre Ville', 'Kumba Ville', 'Mundemba', 'Meme', 'Manyu'
            ],
        ];

        foreach ($neighborhoodsByCity as $cityName => $neighborhoods) {
            $city = City::where('name', $cityName)->first();
            if ($city) {
                foreach ($neighborhoods as $neighborhood) {
                    Neighborhood::create([
                        'name' => $neighborhood,
                        'city_id' => $city->id
                    ]);
                }
            }
        }
    }
}
