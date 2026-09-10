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
            'Yaoundé' => [
                'Emana', 'Etoudi', 'Nlongkak', 'Messassi', 'Tsinga', 'Mokas',
                'Briqueterie', 'Efoulan', 'Obobogo', 'Ahala', 'Mimboman',
                'Kondengui', 'Ekounou', 'Essos', 'Mvog-Ada', 'Ngousso',
                'Biyem-Assi', 'Melen', 'Simbock', 'Nkolbisson'
            ],
            'Douala' => [
                'Akwa', 'Bonanjo', 'Deido', 'Bali', 'New Bell', 'Nkololoun',
                'Logbaba', 'Ndogpassi', 'Nyalla', 'Bonabéri', 'Mambanda',
                'Kotto', 'Logpom', 'Makepe', 'Bépanda', 'Manoka'
            ],
            'Bafoussam' => [
                'Tamja', 'Ndiangdam', 'Baleng', 'Bamougoum'
            ],
            'Garoua' => [
                'Lopéré', 'Roumdé Adjia', 'Djamboutou'
            ],
            'Bamenda' => [
                'Mankon', 'Nkwen'
            ],
            'Maroua' => [
                'Kakataré', 'Pitoaré'
            ],
            'Ngaoundéré' => [
                'Baladji'
            ],
            'Bertoua' => [
                'Kano'
            ],
            'Buea' => [
                'Molyko'
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
