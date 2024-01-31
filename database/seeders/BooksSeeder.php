<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BooksSeeder extends Seeder
{
    public function run()
    {
        Book::factory(100)->create();
    }
}
