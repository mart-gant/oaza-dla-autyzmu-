<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Najczęściej zadawane pytania - Oaza dla Autyzmu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 min-h-screen">
    <!-- Navbar -->
    <nav class="bg-white/90 backdrop-blur-lg shadow-sm sticky top-0 z-50 transition-all duration-300">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <a href="/" class="flex items-center space-x-2 hover:opacity-80 transition-opacity">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-xl">O</span>
                    </div>
                    <span class="font-bold text-xl bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                        Oaza dla Autyzmu
                    </span>
                </a>

                <!-- Navigation -->
                <div class="flex items-center space-x-10">
                    @auth
                        <a href="/home" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">Wyloguj się</button>
                        </form>
                    @else
                        <a href="/login" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">Zaloguj się</a>
                        <a href="/register" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-2.5 rounded-lg font-medium hover:shadow-lg hover:scale-105 transition-all duration-300">
                            Dołącz za darmo
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-16">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Najczęściej zadawane pytania
                </h1>
                <p class="text-xl text-gray-600">
                    Znajdź odpowiedzi na najpopularniejsze pytania dotyczące naszej platformy
                </p>
            </div>

            <!-- FAQ Items -->
            <div class="space-y-6">
                <!-- Q1 -->
                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                    <h3 class="text-xl font-bold text-gray-900 mb-3">
                        Czym jest Oaza dla Autyzmu?
                    </h3>
                    <p class="text-gray-700 leading-relaxed">
                        Oaza dla Autyzmu to platforma dedykowana osobom ze spektrum autyzmu, ich rodzinom oraz specjalistom. Naszym celem jest stworzenie bezpiecznej przestrzeni do dzielenia się doświadczeniami, wyszukiwania ośrodków wsparcia oraz budowania wspierającej społeczności.
                    </p>
                </div>

                <!-- Q2 -->
                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                    <h3 class="text-xl font-bold text-gray-900 mb-3">
                        Czy rejestracja jest bezpłatna?
                    </h3>
                    <p class="text-gray-700 leading-relaxed">
                        Tak! Rejestracja i korzystanie z podstawowych funkcji platformy jest całkowicie bezpłatne. Wierzymy, że dostęp do wsparcia i informacji powinien być dostępny dla wszystkich.
                    </p>
                </div>

                <!-- Q3 -->
                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                    <h3 class="text-xl font-bold text-gray-900 mb-3">
                        Jak mogę dodać opinię o ośrodku?
                    </h3>
                    <p class="text-gray-700 leading-relaxed">
                        Po zalogowaniu się na swoje konto, wyszukaj ośrodek, który chcesz ocenić, kliknij na jego profil i wybierz opcję "Dodaj opinię". Twoje doświadczenia pomogą innym w wyborze odpowiedniego miejsca wsparcia.
                    </p>
                </div>

                <!-- Q4 -->
                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                    <h3 class="text-xl font-bold text-gray-900 mb-3">
                        Czy moje dane są bezpieczne?
                    </h3>
                    <p class="text-gray-700 leading-relaxed">
                        Absolutnie! Bezpieczeństwo Twoich danych jest naszym priorytetem. Stosujemy najnowsze standardy zabezpieczeń, szyfrowanie danych oraz zgodność z RODO. Szczegóły znajdziesz w naszej <a href="/privacy" class="text-blue-600 hover:underline">Polityce prywatności</a>.
                    </p>
                </div>

                <!-- Q5 -->
                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                    <h3 class="text-xl font-bold text-gray-900 mb-3">
                        Jak działa forum społeczności?
                    </h3>
                    <p class="text-gray-700 leading-relaxed">
                        Forum to miejsce, gdzie możesz zadawać pytania, dzielić się doświadczeniami i łączyć się z innymi członkami społeczności. Po rejestracji możesz tworzyć nowe tematy, odpowiadać na posty innych użytkowników i budować wartościowe relacje.
                    </p>
                </div>

                <!-- Q6 -->
                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                    <h3 class="text-xl font-bold text-gray-900 mb-3">
                        Jak mogę zostać specjalistą na platformie?
                    </h3>
                    <p class="text-gray-700 leading-relaxed">
                        Jeśli jesteś specjalistą pracującym z osobami ze spektrum autyzmu, możesz utworzyć konto specjalisty podczas rejestracji. W późniejszym czasie będziesz mógł wypełnić swój profil zawodowy i zacząć łączyć się z rodzinami potrzebującymi wsparcia.
                    </p>
                </div>

                <!-- Q7 -->
                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                    <h3 class="text-xl font-bold text-gray-900 mb-3">
                        Czy mogę usunąć swoje konto?
                    </h3>
                    <p class="text-gray-700 leading-relaxed">
                        Tak, masz pełną kontrolę nad swoim kontem. W ustawieniach profilu znajdziesz opcję usunięcia konta. Pamiętaj, że ta operacja jest nieodwracalna i usunie wszystkie Twoje dane z platformy.
                    </p>
                </div>

                <!-- Q8 -->
                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                    <h3 class="text-xl font-bold text-gray-900 mb-3">
                        Jak mogę zgłosić problem lub otrzymać pomoc?
                    </h3>
                    <p class="text-gray-700 leading-relaxed">
                        Masz kilka opcji: możesz skorzystać z formularza kontaktowego na stronie <a href="/contact" class="text-blue-600 hover:underline">Kontakt</a>, napisać do nas e-mail lub zgłosić problem bezpośrednio przez platformę. Nasz zespół odpowie tak szybko, jak to możliwe.
                    </p>
                </div>
            </div>

            <!-- Additional Help -->
            <div class="mt-12 bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl p-8 text-center text-white">
                <h2 class="text-2xl font-bold mb-3">Nie znalazłeś odpowiedzi?</h2>
                <p class="text-lg mb-6 text-blue-50">
                    Skontaktuj się z nami - chętnie pomożemy!
                </p>
                <a href="/contact" class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition-colors">
                    Skontaktuj się
                </a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-blue-900 via-purple-900 to-blue-900 text-white py-8 mt-16">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2026 Oaza dla Autyzmu. Wszystkie prawa zastrzeżone.</p>
            <div class="mt-4 space-x-6">
                <a href="/faq" class="hover:text-blue-300 transition-colors">FAQ</a>
                <a href="/privacy" class="hover:text-blue-300 transition-colors">Polityka prywatności</a>
                <a href="/terms" class="hover:text-blue-300 transition-colors">Regulamin</a>
                <a href="/contact" class="hover:text-blue-300 transition-colors">Kontakt</a>
            </div>
        </div>
    </footer>
</body>
</html>
