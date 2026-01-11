<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ForumCategory;

class ForumCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Diagnoza i terapia',
            'Edukacja i przedszkola',
            'Życie codzienne',
            'Wsparcie dla rodziców',
            'Integracja sensoryczna',
            'Logopedia i komunikacja',
            'Doświadczenia i porady',
            'Pytania i odpowiedzi',
        ];

        foreach ($categories as $category) {
            ForumCategory::create(['name' => $category]);
        }
    }
}
