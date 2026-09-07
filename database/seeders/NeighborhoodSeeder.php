<?php

namespace Database\Seeders;

use App\Models\Neighborhood;
use Illuminate\Database\Seeder;

class NeighborhoodSeeder extends Seeder
{
    public function run(): void
    {
        $neighborhoods = [
            'Cocody', 'Plateau', 'Marcory', 'Yopougon', 'Adjamé',
            'Treichville', 'Koumassi', 'Port-Bouët', 'Abobo', 'Attécoubé',
            'Bingerville', 'Anyama', 'Songon', 'Brofodoumé', 'Attecoubé'
        ];

        foreach ($neighborhoods as $neighborhood) {
            Neighborhood::create(['name' => $neighborhood]);
        }
    }
}
