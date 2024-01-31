<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;

class CoursesSeeder extends Seeder
{
    public function run()
    {
        $filePath = Storage::disk('public')->path('courses.json');
        $jsonContent = json_decode(file_get_contents($filePath), true);
        $coursesData = $jsonContent[2]['data'];

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
