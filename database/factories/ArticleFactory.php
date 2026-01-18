<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        // Fallback for production where faker might not be available
        $titles = [
            'Jak wspierać rozwój dziecka z autyzmem',
            'Najważniejsze informacje o terapii ABA',
            'Integracja sensoryczna - podstawy',
            'Komunikacja alternatywna w autyzmie',
            'Edukacja włączająca - jak to działa',
            'Prawa osób z niepełnosprawnościami',
            'Terapia logopedyczna dla dzieci z autyzmem',
            'Jak wybrać odpowiednią placówkę',
            'Wsparcie dla rodzin dzieci z autyzmem',
            'Diagnostyka autyzmu - co warto wiedzieć',
        ];
        
        $contents = [
            "Wspieranie rozwoju dziecka z autyzmem wymaga holistycznego podejścia. Kluczowe jest zrozumienie indywidualnych potrzeb dziecka i dostosowanie metod wsparcia. Ważne elementy to: regularna terapia, wsparcie rodziny, odpowiednia edukacja i cierpliwość w codziennych działaniach.\n\nPamiętaj, że każde dziecko jest wyjątkowe i rozwija się we własnym tempie.",
            "Terapia behawioralna ABA to jedna z najbardziej uznanych metod pracy z dziećmi ze spektrum autyzmu. Opiera się na naukowych zasadach uczenia się i pozytywnym wzmacnianiu pożądanych zachowań.\n\nTerapia ABA jest dostosowywana indywidualnie do potrzeb każdego dziecka i może być prowadzona w różnych środowiskach.",
            "Integracja sensoryczna to proces przetwarzania informacji zmysłowych przez mózg. Dzieci z autyzmem często mają trudności w tym obszarze, co może wpływać na ich codzienne funkcjonowanie.\n\nTerapia SI pomaga dziecku lepiej radzić sobie z bodźcami sensorycznymi i poprawia jakość życia.",
            "Komunikacja alternatywna obejmuje różne metody wspierające porozumiewanie się osób, które mają trudności z mową. PECS, AAC i inne systemy mogą znacząco poprawić jakość życia.\n\nWprowadzenie komunikacji alternatywnej powinno być konsultowane ze specjalistami.",
            "Edukacja włączająca to model, w którym dzieci z różnymi potrzebami uczą się razem w jednej klasie. Wymaga odpowiedniego wsparcia i dostosowań, ale przynosi korzyści wszystkim uczniom.\n\nKluczem jest dobre przygotowanie nauczycieli i akceptacja w środowisku szkolnym.",
        ];
        
        $randomIndex = rand(0, count($titles) - 1);
        $title = $titles[$randomIndex] . ' ' . rand(1000, 9999);
        $content = $contents[$randomIndex % count($contents)];
        
        $isPublished = rand(0, 100) < 80;
        $publishedAt = $isPublished ? now()->subDays(rand(1, 180)) : null;
        
        return [
            'title' => $title,
            'content' => $content,
            'user_id' => User::factory(),
            'slug' => Str::slug($title) . '-' . rand(1000, 9999),
            'is_published' => $isPublished,
            'published_at' => $publishedAt,
        ];
    }

    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_published' => true,
            'published_at' => now()->subDays(rand(1, 180)),
        ]);
    }

    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_published' => false,
            'published_at' => null,
        ]);
    }
}
