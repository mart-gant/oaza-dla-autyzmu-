<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polityka prywatności - Oaza dla Autyzmu</title>
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
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8 md:p-12">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Polityka prywatności
                </h1>
                <p class="text-gray-600">
                    Ostatnia aktualizacja: 8 stycznia 2026
                </p>
            </div>

            <!-- Content -->
            <div class="prose prose-lg max-w-none">
                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">1. Wprowadzenie</h2>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        Oaza dla Autyzmu ("my", "nas", "nasz") szanuje Twoją prywatność i zobowiązuje się do ochrony Twoich danych osobowych. Niniejsza polityka prywatności wyjaśnia, jak zbieramy, wykorzystujemy, przechowujemy i chronimy Twoje informacje podczas korzystania z naszej platformy.
                    </p>
                    <p class="text-gray-700 leading-relaxed">
                        Przetwarzamy dane osobowe zgodnie z Rozporządzeniem Parlamentu Europejskiego i Rady (UE) 2016/679 z dnia 27 kwietnia 2016 r. w sprawie ochrony osób fizycznych w związku z przetwarzaniem danych osobowych (RODO).
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">2. Administrator danych</h2>
                    <p class="text-gray-700 leading-relaxed">
                        Administratorem Twoich danych osobowych jest Oaza dla Autyzmu. W sprawach związanych z ochroną danych możesz skontaktować się ze mną poprzez formularz kontaktowy dostępny na stronie.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">3. Jakie dane zbieramy?</h2>
                    <div class="ml-4">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">3.1 Dane podane przez użytkownika:</h3>
                        <ul class="list-disc ml-6 space-y-2 text-gray-700">
                            <li>Imię i nazwisko</li>
                            <li>Adres e-mail</li>
                            <li>Hasło (w formie zaszyfrowanej)</li>
                            <li>Dodatkowe informacje profilowe (opcjonalne, np. zainteresowania, preferencje wsparcia)</li>
                            <li>Treści tworzone na platformie (opinie, posty na forum, komentarze)</li>
                        </ul>

                        <h3 class="text-xl font-semibold text-gray-900 mb-3 mt-6">3.2 Dane zbierane automatycznie:</h3>
                        <ul class="list-disc ml-6 space-y-2 text-gray-700">
                            <li>Adres IP</li>
                            <li>Typ przeglądarki i urządzenia</li>
                            <li>Dane o aktywności na stronie (odwiedzane podstrony, czas spędzony na stronie)</li>
                            <li>Pliki cookie i podobne technologie</li>
                        </ul>
                    </div>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">4. W jakim celu wykorzystujemy dane?</h2>
                    <ul class="list-disc ml-6 space-y-2 text-gray-700">
                        <li>Tworzenie i zarządzanie kontem użytkownika</li>
                        <li>Świadczenie usług dostępnych na platformie</li>
                        <li>Komunikacja z użytkownikami (powiadomienia, odpowiedzi na zapytania)</li>
                        <li>Zapewnienie bezpieczeństwa i przeciwdziałanie nadużyciom</li>
                        <li>Doskonalenie funkcjonalności platformy</li>
                        <li>Analiza statystyk i optymalizacja doświadczeń użytkowników</li>
                        <li>Wypełnianie obowiązków prawnych</li>
                    </ul>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">5. Podstawa prawna przetwarzania</h2>
                    <p class="text-gray-700 leading-relaxed mb-3">
                        Twoje dane przetwarzamy na podstawie:
                    </p>
                    <ul class="list-disc ml-6 space-y-2 text-gray-700">
                        <li><strong>Zgody</strong> - art. 6 ust. 1 lit. a RODO (np. newsletter, opcjonalne dane profilowe)</li>
                        <li><strong>Wykonania umowy</strong> - art. 6 ust. 1 lit. b RODO (świadczenie usług platformy)</li>
                        <li><strong>Prawnie uzasadnionego interesu</strong> - art. 6 ust. 1 lit. f RODO (bezpieczeństwo, analityka)</li>
                        <li><strong>Obowiązku prawnego</strong> - art. 6 ust. 1 lit. c RODO (zgodność z przepisami)</li>
                    </ul>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">6. Udostępnianie danych</h2>
                    <p class="text-gray-700 leading-relaxed mb-3">
                        Nie sprzedajemy Twoich danych osobowych. Możemy udostępniać dane tylko w następujących przypadkach:
                    </p>
                    <ul class="list-disc ml-6 space-y-2 text-gray-700">
                        <li>Dostawcom usług IT wspierającym działanie platformy (hosting, analityka)</li>
                        <li>Organom państwowym, gdy wymaga tego prawo</li>
                        <li>Za Twoją wyraźną zgodą</li>
                    </ul>
                    <p class="text-gray-700 leading-relaxed mt-3">
                        Wszyscy nasi partnerzy są zobowiązani do ochrony Twoich danych zgodnie z obowiązującymi przepisami.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">7. Przechowywanie danych</h2>
                    <p class="text-gray-700 leading-relaxed">
                        Przechowujemy Twoje dane przez okres niezbędny do realizacji celów, dla których zostały zebrane, lub przez okres wymagany przez przepisy prawa. Po usunięciu konta Twoje dane zostaną trwale usunięte z naszych systemów, z wyjątkiem informacji, które musimy zachować ze względów prawnych.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">8. Twoje prawa</h2>
                    <p class="text-gray-700 leading-relaxed mb-3">
                        Zgodnie z RODO przysługują Ci następujące prawa:
                    </p>
                    <ul class="list-disc ml-6 space-y-2 text-gray-700">
                        <li><strong>Prawo dostępu</strong> do swoich danych osobowych</li>
                        <li><strong>Prawo do sprostowania</strong> nieprawidłowych danych</li>
                        <li><strong>Prawo do usunięcia</strong> danych ("prawo do bycia zapomnianym")</li>
                        <li><strong>Prawo do ograniczenia przetwarzania</strong></li>
                        <li><strong>Prawo do przenoszenia</strong> danych</li>
                        <li><strong>Prawo do sprzeciwu</strong> wobec przetwarzania</li>
                        <li><strong>Prawo do cofnięcia zgody</strong> w dowolnym momencie</li>
                        <li><strong>Prawo do wniesienia skargi</strong> do organu nadzorczego (UODO)</li>
                    </ul>
                    <p class="text-gray-700 leading-relaxed mt-3">
                        Aby skorzystać z tych praw, skontaktuj się ze mną poprzez formularz kontaktowy.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">9. Pliki cookie</h2>
                    <p class="text-gray-700 leading-relaxed">
                        Nasza strona wykorzystuje pliki cookie do zapewnienia prawidłowego działania platformy, zapamiętywania preferencji użytkowników oraz analizy ruchu. Możesz zarządzać ustawieniami plików cookie w swojej przeglądarce. Więcej informacji o plikach cookie znajdziesz w naszej Polityce cookies.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">10. Bezpieczeństwo</h2>
                    <p class="text-gray-700 leading-relaxed">
                        Stosujemy odpowiednie środki techniczne i organizacyjne w celu ochrony Twoich danych przed nieuprawnionym dostępem, utratą, zniszczeniem lub zmianą. Obejmuje to szyfrowanie połączeń (SSL/TLS), bezpieczne przechowywanie haseł oraz regularne audyty bezpieczeństwa.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">11. Zmiany w polityce prywatności</h2>
                    <p class="text-gray-700 leading-relaxed">
                        Możemy okresowo aktualizować niniejszą politykę prywatności. O istotnych zmianach poinformujemy Cię za pośrednictwem platformy lub e-maila. Data ostatniej aktualizacji jest widoczna na górze dokumentu.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">12. Kontakt</h2>
                    <p class="text-gray-700 leading-relaxed">
                        W razie pytań dotyczących niniejszej polityki prywatności lub przetwarzania Twoich danych osobowych, skontaktuj się ze mną poprzez <a href="/contact" class="text-blue-600 hover:underline">formularz kontaktowy</a>.
                    </p>
                </section>
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
