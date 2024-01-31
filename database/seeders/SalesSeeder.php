<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sale;

class SalesSeeder extends Seeder
{
    public function run()
    {
        Sale::factory(100)->create();
    }
}

