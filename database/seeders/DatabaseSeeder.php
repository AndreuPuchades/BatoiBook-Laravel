<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(FamiliesSeeder::class);
        $this->call(CoursesSeeder::class);
        $this->call(ModulesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(BooksSeeder::class);
        $this->call(SalesSeeder::class);
    }

}
