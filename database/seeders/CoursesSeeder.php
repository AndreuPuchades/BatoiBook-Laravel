<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;

class CoursesSeeder extends Seeder
{
    public function run()
    {
        // Obtenir el path del fitxer JSON
        $filePath = Storage::disk('public')->path('courses.json');

        // Llegir i decodificar el fitxer JSON
        $jsonContent = json_decode(file_get_contents($filePath), true);

        // Accedir a les dades del JSON
        $coursesData = $jsonContent[2]['data'];

        // Inserir les dades a la taula
        foreach ($coursesData as $courseData) {
            Course::create([
                'id' => $courseData['id'],
                'cycle' => $courseData['cycle'],
                'idFamily' => $courseData['idFamily'],
                'vliteral' => $courseData['vliteral'],
                'cliteral' => $courseData['cliteral'],
            ]);
        }
    }
}
