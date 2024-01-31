<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;
use Illuminate\Support\Facades\Storage;

class ModulesSeeder extends Seeder
{
    public function run()
    {
        $filePath = Storage::disk('public')->path('modules.json');
        $jsonContent = json_decode(file_get_contents($filePath), true);
        $modulesData = $jsonContent[2]['data'];

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
