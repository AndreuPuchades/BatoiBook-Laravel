<?php

namespace Database\Seeders;

use App\Models\Family;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class FamiliesSeeder extends Seeder
{
    public function run()
    {
        $filePath = Storage::disk('public')->path('families.json');
        $jsonContent = json_decode(file_get_contents($filePath), true);
        $familiesData = $jsonContent[2]['data'];

        foreach ($familiesData as $familyData) {
            Family::create([
                'id' => $familyData['id'],
                'cliteral' => $familyData['cliteral'],
                'vliteral' => $familyData['vliteral'],
            ]);
        }
    }
}
