<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    public function run()
    {
        User::query()->delete();
        $response = Http::get('https://swapi.dev/api/people/');
        if ($response->successful()) {
            $data = $response->json();
            foreach ($data['results'] as $character) {
                User::create([
                    'name' => $character['name'],
                    'email' => strtolower(str_replace(' ', '', $character['name'])) . '@starwars.com',
                    'email_verified_at' => now(),
                    'password' => Hash::make('1234'),
                    'remember_token' => Str::random(10),
                ]);
            }

        } else {
            $this->command->error('Error en la petició a l\'API de Star Wars');
        }

        User::factory()->admin()->create();
        User::factory(100)->create();
    }
}
