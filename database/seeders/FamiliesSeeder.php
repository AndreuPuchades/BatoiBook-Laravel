<?php

namespace Database\Seeders;

use App\Models\Family;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class FamiliesSeeder extends Seeder
{
    public function run()
    {
        // Obtenir el path del fitxer JSON
        $filePath = Storage::disk('public')->path('families.json');

        // Llegir i decodificar el fitxer JSON
        $jsonContent = json_decode(file_get_contents($filePath), true);

        // Accedir a les dades del JSON
        $familiesData = $jsonContent[2]['data'];

        // Inserir les dades a la taula
        foreach ($familiesData as $familyData) {
            Family::create([
                'id' => $familyData['id'],
                'cliteral' => $familyData['cliteral'],
                'vliteral' => $familyData['vliteral'],
            ]);
        }
    }
}
