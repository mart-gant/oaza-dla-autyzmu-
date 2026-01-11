<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polityka cookies - Oaza dla Autyzmu</title>
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
                    Polityka cookies
                </h1>
                <p class="text-gray-600">
                    Ostatnia aktualizacja: 8 stycznia 2026
                </p>
            </div>

            <!-- Content -->
            <div class="prose prose-lg max-w-none">
                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">1. Co to są pliki cookie?</h2>
                    <p class="text-gray-700 leading-relaxed">
                        Pliki cookie (ciasteczka) to małe pliki tekstowe zapisywane na Twoim urządzeniu (komputerze, tablecie, smartfonie) podczas przeglądania stron internetowych. Pliki cookie umożliwiają stronie internetowej rozpoznanie Twojego urządzenia i zapamiętanie określonych informacji o Twojej wizycie, takich jak preferencje językowe czy ustawienia.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">2. Jakie rodzaje cookies używamy?</h2>
                    
                    <div class="mb-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">2.1 Niezbędne pliki cookie (strictly necessary)</h3>
                        <p class="text-gray-700 leading-relaxed mb-2">
                            Te pliki cookie są niezbędne do prawidłowego działania strony i nie można ich wyłączyć. Są ustawiane tylko w odpowiedzi na Twoje działania, takie jak logowanie, wypełnianie formularzy lub ustawienia prywatności.
                        </p>
                        <ul class="list-disc ml-6 space-y-2 text-gray-700">
                            <li><strong>XSRF-TOKEN</strong> - token bezpieczeństwa chroniący przed atakami CSRF</li>
                            <li><strong>laravel_session</strong> - identyfikator sesji użytkownika</li>
                            <li><strong>cookie_consent</strong> - zapisuje Twoje preferencje dotyczące cookies</li>
                        </ul>
                        <p class="text-gray-600 text-sm mt-2">Czas przechowywania: czas sesji lub do 2 godzin</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">2.2 Funkcjonalne pliki cookie</h3>
                        <p class="text-gray-700 leading-relaxed mb-2">
                            Te pliki cookie umożliwiają zapamiętanie wyborów dokonanych przez użytkownika, takich jak język, region czy tryb wyświetlania. Wymagają Twojej zgody.
                        </p>
                        <ul class="list-disc ml-6 space-y-2 text-gray-700">
                            <li><strong>user_preferences</strong> - zapisuje preferencje dotyczące wyglądu i funkcjonalności</li>
                            <li><strong>language</strong> - zapamiętuje preferowany język interfejsu</li>
                        </ul>
                        <p class="text-gray-600 text-sm mt-2">Czas przechowywania: do 12 miesięcy</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">2.3 Analityczne pliki cookie</h3>
                        <p class="text-gray-700 leading-relaxed mb-2">
                            Te pliki cookie pozwalają nam zrozumieć, jak odwiedzający korzystają ze strony, identyfikować błędy i mierzyć wydajność. Wszystkie zebrane informacje są zagregowane i anonimowe. Wymagają Twojej zgody.
                        </p>
                        <ul class="list-disc ml-6 space-y-2 text-gray-700">
                            <li><strong>Google Analytics</strong> (_ga, _gid, _gat) - analiza ruchu na stronie</li>
                            <li>Informacje zbierane: strony odwiedzone, czas spędzony, źródło ruchu, urządzenie</li>
                        </ul>
                        <p class="text-gray-600 text-sm mt-2">Czas przechowywania: od 24 godzin do 2 lat</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">2.4 Marketingowe pliki cookie</h3>
                        <p class="text-gray-700 leading-relaxed mb-2">
                            Obecnie nie używamy marketingowych plików cookie. W przyszłości mogą być używane do wyświetlania spersonalizowanych reklam, ale wyłącznie po uzyskaniu Twojej zgody.
                        </p>
                    </div>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">3. Podstawa prawna używania cookies</h2>
                    <p class="text-gray-700 leading-relaxed mb-3">
                        Używanie plików cookie regulują następujące przepisy:
                    </p>
                    <ul class="list-disc ml-6 space-y-2 text-gray-700">
                        <li>Rozporządzenie Parlamentu Europejskiego i Rady (UE) 2016/679 (RODO)</li>
                        <li>Dyrektywa 2002/58/WE (Dyrektywa ePrivacy)</li>
                        <li>Ustawa z dnia 18 lipca 2002 r. o świadczeniu usług drogą elektroniczną</li>
                        <li>Ustawa z dnia 16 lipca 2004 r. Prawo telekomunikacyjne</li>
                    </ul>
                    <p class="text-gray-700 leading-relaxed mt-3">
                        Zgodnie z tymi przepisami, przed zapisaniem na Twoim urządzeniu plików cookie (z wyjątkiem cookies niezbędnych), musimy uzyskać Twoją świadomą i jednoznaczną zgodę.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">4. Wyrażanie i wycofywanie zgody</h2>
                    <div class="space-y-4 text-gray-700">
                        <p class="leading-relaxed">
                            <strong>4.1 Wyrażanie zgody:</strong> Przy pierwszej wizycie na stronie pojawi się banner informacyjny o cookies, w którym możesz wyrazić zgodę na używanie poszczególnych kategorii cookies lub odrzucić cookies opcjonalne.
                        </p>
                        <p class="leading-relaxed">
                            <strong>4.2 Zmiana ustawień:</strong> W każdej chwili możesz zmienić swoje preferencje dotyczące cookies, klikając link "Ustawienia cookies" w stopce strony.
                        </p>
                        <p class="leading-relaxed">
                            <strong>4.3 Wycofanie zgody:</strong> Możesz w każdej chwili wycofać zgodę na używanie cookies poprzez panel ustawień lub usuwając pliki cookie w przeglądarce. Wycofanie zgody nie wpływa na zgodność z prawem przetwarzania danych przed jej wycofaniem.
                        </p>
                    </div>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">5. Zarządzanie cookies w przeglądarce</h2>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        Możesz również zarządzać plikami cookie bezpośrednio w swojej przeglądarce. Większość przeglądarek domyślnie akceptuje pliki cookie, ale możesz zmienić te ustawienia. Poniżej znajdziesz instrukcje dla popularnych przeglądarek:
                    </p>
                    <ul class="list-disc ml-6 space-y-2 text-gray-700">
                        <li><strong>Google Chrome:</strong> Ustawienia → Prywatność i bezpieczeństwo → Pliki cookie i inne dane witryn</li>
                        <li><strong>Mozilla Firefox:</strong> Opcje → Prywatność i bezpieczeństwo → Ciasteczka i dane stron</li>
                        <li><strong>Microsoft Edge:</strong> Ustawienia → Pliki cookie i uprawnienia witryny</li>
                        <li><strong>Safari:</strong> Preferencje → Prywatność → Zarządzaj danymi witryn</li>
                    </ul>
                    <p class="text-gray-700 leading-relaxed mt-4">
                        <strong>Uwaga:</strong> Wyłączenie plików cookie może wpłynąć na funkcjonalność strony. Niektóre funkcje mogą nie działać prawidłowo bez cookies.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">6. Pliki cookie podmiotów trzecich</h2>
                    <p class="text-gray-700 leading-relaxed mb-3">
                        Niektóre pliki cookie mogą być ustawiane przez zewnętrzne usługi, które używamy:
                    </p>
                    <ul class="list-disc ml-6 space-y-2 text-gray-700">
                        <li><strong>Google Analytics:</strong> Pomaga nam analizować ruch na stronie. <a href="https://policies.google.com/privacy" target="_blank" class="text-blue-600 hover:underline">Polityka prywatności Google</a></li>
                        <li><strong>Google Fonts:</strong> Czcionki używane na stronie mogą generować cookies. <a href="https://policies.google.com/privacy" target="_blank" class="text-blue-600 hover:underline">Polityka prywatności Google</a></li>
                    </ul>
                    <p class="text-gray-700 leading-relaxed mt-3">
                        Nie mamy kontroli nad plikami cookie ustawianymi przez podmioty trzecie. Zalecamy zapoznanie się z polityką prywatności tych podmiotów.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">7. Twoje prawa</h2>
                    <p class="text-gray-700 leading-relaxed mb-3">
                        W związku z przetwarzaniem danych za pomocą cookies przysługują Ci następujące prawa:
                    </p>
                    <ul class="list-disc ml-6 space-y-2 text-gray-700">
                        <li>Prawo dostępu do swoich danych</li>
                        <li>Prawo do sprostowania danych</li>
                        <li>Prawo do usunięcia danych</li>
                        <li>Prawo do ograniczenia przetwarzania</li>
                        <li>Prawo do sprzeciwu wobec przetwarzania</li>
                        <li>Prawo do przenoszenia danych</li>
                        <li>Prawo do wycofania zgody w dowolnym momencie</li>
                        <li>Prawo do wniesienia skargi do UODO</li>
                    </ul>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">8. Zmiany w polityce cookies</h2>
                    <p class="text-gray-700 leading-relaxed">
                        Możemy okresowo aktualizować niniejszą politykę cookies, aby odzwierciedlić zmiany w naszych praktykach lub ze względów operacyjnych, prawnych lub regulacyjnych. O istotnych zmianach poinformujemy Cię poprzez aktualizację daty "Ostatnia aktualizacja" na górze tego dokumentu.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">9. Kontakt</h2>
                    <p class="text-gray-700 leading-relaxed">
                        W razie pytań dotyczących niniejszej polityki cookies lub sposobu wykorzystania plików cookie na naszej stronie, skontaktuj się z nami poprzez <a href="/contact" class="text-blue-600 hover:underline">formularz kontaktowy</a>.
                    </p>
                </section>

                <div class="bg-blue-50 border-l-4 border-blue-600 p-6 mt-8 rounded">
                    <h3 class="font-bold text-gray-900 mb-2">📋 Szybki dostęp</h3>
                    <div class="space-y-2">
                        <p class="text-gray-700">
                            <a href="#" onclick="openCookieSettings(); return false;" class="text-blue-600 hover:underline font-medium">⚙️ Zarządzaj ustawieniami cookies</a>
                        </p>
                        <p class="text-gray-700">
                            <a href="/privacy" class="text-blue-600 hover:underline font-medium">🔒 Polityka prywatności</a>
                        </p>
                        <p class="text-gray-700">
                            <a href="/terms" class="text-blue-600 hover:underline font-medium">📜 Regulamin</a>
                        </p>
                    </div>
                </div>
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
                <a href="/cookies" class="hover:text-blue-300 transition-colors">Polityka cookies</a>
                <a href="/terms" class="hover:text-blue-300 transition-colors">Regulamin</a>
                <a href="/contact" class="hover:text-blue-300 transition-colors">Kontakt</a>
            </div>
        </div>
    </footer>

    <script>
        function openCookieSettings() {
            if (typeof window.showCookieBanner === 'function') {
                window.showCookieBanner();
            } else {
                alert('Panel zarządzania cookies będzie dostępny wkrótce.');
            }
        }
    </script>
</body>
</html>
