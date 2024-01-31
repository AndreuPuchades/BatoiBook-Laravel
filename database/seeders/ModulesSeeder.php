<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;
use Illuminate\Support\Facades\Storage;

class ModulesSeeder extends Seeder
{
    public function run()
    {
        // Obtenir el path del fitxer JSON
        $filePath = Storage::disk('public')->path('modules.json');

        // Llegir i decodificar el fitxer JSON
        $jsonContent = json_decode(file_get_contents($filePath), true);

        // Acceder a los datos del JSON
        $modulesData = $jsonContent[2]['data'];

        // Insertar los datos en la tabla
        foreach ($modulesData as $moduleData) {
            Module::create([
                'code' => $moduleData['code'],
                'cliteral' => $moduleData['cliteral'],
                'vliteral' => $moduleData['vliteral'],
                'idCycle' => $moduleData['idCycle'],
            ]);
        }
    }
}
