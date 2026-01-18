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
            [
                'name' => 'Diagnoza i terapia',
                'description' => 'Dyskusje na temat diagnostyki autyzmu i dostępnych form terapii',
            ],
            [
                'name' => 'Edukacja i przedszkola',
                'description' => 'Wymiana doświadczeń dotyczących edukacji dzieci ze spektrum autyzmu',
            ],
            [
                'name' => 'Życie codzienne',
                'description' => 'Porady i wskazówki dotyczące codziennego funkcjonowania',
            ],
            [
                'name' => 'Wsparcie dla rodziców',
                'description' => 'Miejsce wymiany doświadczeń i wzajemnego wspierania się rodziców',
            ],
            [
                'name' => 'Integracja sensoryczna',
                'description' => 'Wszystko o terapii SI i trudnościach sensorycznych',
            ],
            [
                'name' => 'Logopedia i komunikacja',
                'description' => 'Tematy związane z rozwojem mowy i komunikacją alternatywną',
            ],
            [
                'name' => 'Doświadczenia i porady',
                'description' => 'Praktyczne porady i historie z życia',
            ],
            [
                'name' => 'Pytania i odpowiedzi',
                'description' => 'Zadaj pytanie społeczności',
            ],
        ];

        foreach ($categories as $category) {
            ForumCategory::create($category);
        }
    }
}
