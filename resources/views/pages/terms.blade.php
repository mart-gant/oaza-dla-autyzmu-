<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regulamin - Oaza dla Autyzmu</title>
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
                    Regulamin platformy
                </h1>
                <p class="text-gray-600">
                    Ostatnia aktualizacja: 8 stycznia 2026
                </p>
            </div>

            <!-- Content -->
            <div class="prose prose-lg max-w-none">
                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">1. Postanowienia ogólne</h2>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        Niniejszy Regulamin określa zasady korzystania z platformy Oaza dla Autyzmu (dalej: "Platforma"). Korzystając z Platformy, akceptujesz postanowienia niniejszego Regulaminu.
                    </p>
                    <p class="text-gray-700 leading-relaxed">
                        Administratorem Platformy jest Oaza dla Autyzmu. Kontakt możliwy jest poprzez formularz kontaktowy dostępny na stronie.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">2. Definicje</h2>
                    <ul class="list-disc ml-6 space-y-2 text-gray-700">
                        <li><strong>Platforma</strong> - serwis internetowy dostępny pod adresem oaza-dla-autyzmu.pl</li>
                        <li><strong>Użytkownik</strong> - osoba korzystająca z Platformy</li>
                        <li><strong>Konto</strong> - indywidualny profil użytkownika utworzony w Platformie</li>
                        <li><strong>Treść</strong> - wszelkie informacje, teksty, obrazy i inne materiały publikowane przez użytkowników</li>
                        <li><strong>Ośrodek</strong> - placówka świadcząca wsparcie dla osób ze spektrum autyzmu</li>
                    </ul>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">3. Rejestracja i konto użytkownika</h2>
                    <div class="space-y-4 text-gray-700">
                        <p class="leading-relaxed">
                            <strong>3.1</strong> Korzystanie z pełnej funkcjonalności Platformy wymaga utworzenia konta poprzez wypełnienie formularza rejestracyjnego.
                        </p>
                        <p class="leading-relaxed">
                            <strong>3.2</strong> Użytkownik zobowiązuje się do podania prawdziwych danych podczas rejestracji.
                        </p>
                        <p class="leading-relaxed">
                            <strong>3.3</strong> Użytkownik ponosi odpowiedzialność za bezpieczeństwo swojego hasła i nie powinien udostępniać go osobom trzecim.
                        </p>
                        <p class="leading-relaxed">
                            <strong>3.4</strong> Jedno konto może być używane tylko przez jedną osobę.
                        </p>
                        <p class="leading-relaxed">
                            <strong>3.5</strong> Użytkownik może w każdej chwili usunąć swoje konto w ustawieniach profilu.
                        </p>
                    </div>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">4. Zasady korzystania z Platformy</h2>
                    <p class="text-gray-700 leading-relaxed mb-3">
                        Użytkownik zobowiązuje się do:
                    </p>
                    <ul class="list-disc ml-6 space-y-2 text-gray-700">
                        <li>Przestrzegania obowiązujących przepisów prawa</li>
                        <li>Szanowania praw innych użytkowników</li>
                        <li>Publikowania treści zgodnych z prawdą i wartościowych dla społeczności</li>
                        <li>Niestosowania mowy nienawiści, dyskryminacji lub przemocy</li>
                        <li>Niepublikowania treści o charakterze reklamowym bez zgody administratora</li>
                        <li>Nieingerowania w funkcjonowanie Platformy</li>
                        <li>Niewykorzystywania Platformy do celów niezgodnych z prawem</li>
                    </ul>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">5. Publikowanie treści</h2>
                    <div class="space-y-4 text-gray-700">
                        <p class="leading-relaxed">
                            <strong>5.1</strong> Użytkownik ponosi pełną odpowiedzialność za treści, które publikuje na Platformie.
                        </p>
                        <p class="leading-relaxed">
                            <strong>5.2</strong> Zabrania się publikowania treści:
                        </p>
                        <ul class="list-disc ml-6 space-y-2 mb-4">
                            <li>Naruszających prawa autorskie, znaki towarowe lub inne prawa własności intelektualnej</li>
                            <li>Obraźliwych, wulgarnych, obscenicznych lub pornograficznych</li>
                            <li>Zawierających mowę nienawiści lub dyskryminację</li>
                            <li>Zawierających groźby, przemoc lub zachęcanie do działań nielegalnych</li>
                            <li>Naruszających prywatność innych osób</li>
                            <li>Spam lub treści reklamowych bez zgody</li>
                            <li>Wprowadzających w błąd lub zawierających fałszywe informacje</li>
                        </ul>
                        <p class="leading-relaxed">
                            <strong>5.3</strong> Administrator zastrzega sobie prawo do usunięcia lub moderacji treści naruszających niniejszy Regulamin.
                        </p>
                        <p class="leading-relaxed">
                            <strong>5.4</strong> Publikując treści na Platformie, użytkownik udziela administratorowi niewyłącznej licencji na ich wykorzystanie w zakresie niezbędnym do funkcjonowania Platformy.
                        </p>
                    </div>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">6. Opinie o ośrodkach</h2>
                    <div class="space-y-4 text-gray-700">
                        <p class="leading-relaxed">
                            <strong>6.1</strong> Użytkownicy mogą publikować opinie o ośrodkach, które odwiedzili lub z których usług korzystali.
                        </p>
                        <p class="leading-relaxed">
                            <strong>6.2</strong> Opinie powinny być obiektywne, prawdziwe i oparte na rzeczywistych doświadczeniach.
                        </p>
                        <p class="leading-relaxed">
                            <strong>6.3</strong> Zabrania się publikowania fałszywych opinii, opinii na zamówienie lub opinii mających na celu celowe zaszkodzenie reputacji ośrodka.
                        </p>
                        <p class="leading-relaxed">
                            <strong>6.4</strong> Administrator zastrzega sobie prawo do weryfikacji i usuwania opinii podejrzanych o niezgodność z regulaminem.
                        </p>
                    </div>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">7. Forum społeczności</h2>
                    <div class="space-y-4 text-gray-700">
                        <p class="leading-relaxed">
                            <strong>7.1</strong> Forum służy do wymiany doświadczeń i wzajemnego wspierania się członków społeczności.
                        </p>
                        <p class="leading-relaxed">
                            <strong>7.2</strong> Dyskusje na forum powinny być merytoryczne i prowadzone w kulturalny sposób.
                        </p>
                        <p class="leading-relaxed">
                            <strong>7.3</strong> Zabrania się spamowania, trollingu i prowokowania innych użytkowników.
                        </p>
                        <p class="leading-relaxed">
                            <strong>7.4</strong> Moderatorzy forum mają prawo do interwencji w przypadku naruszenia zasad.
                        </p>
                    </div>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">8. Odpowiedzialność</h2>
                    <div class="space-y-4 text-gray-700">
                        <p class="leading-relaxed">
                            <strong>8.1</strong> Administrator dokłada wszelkich starań, aby Platforma działała prawidłowo, jednak nie gwarantuje nieprzerwanego działania.
                        </p>
                        <p class="leading-relaxed">
                            <strong>8.2</strong> Administrator nie ponosi odpowiedzialności za treści publikowane przez użytkowników.
                        </p>
                        <p class="leading-relaxed">
                            <strong>8.3</strong> Administrator nie ponosi odpowiedzialności za decyzje podjęte przez użytkowników na podstawie informacji znalezionych na Platformie.
                        </p>
                        <p class="leading-relaxed">
                            <strong>8.4</strong> Użytkownik korzysta z Platformy na własną odpowiedzialność.
                        </p>
                    </div>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">9. Sankcje</h2>
                    <div class="space-y-4 text-gray-700">
                        <p class="leading-relaxed">
                            <strong>9.1</strong> W przypadku naruszenia Regulaminu administrator może zastosować następujące sankcje:
                        </p>
                        <ul class="list-disc ml-6 space-y-2 mb-4">
                            <li>Ostrzeżenie</li>
                            <li>Usunięcie treści naruszających regulamin</li>
                            <li>Czasowe zawieszenie konta</li>
                            <li>Trwałe usunięcie konta</li>
                            <li>Zgłoszenie do odpowiednich organów (w przypadku naruszenia prawa)</li>
                        </ul>
                        <p class="leading-relaxed">
                            <strong>9.2</strong> Administrator zastrzega sobie prawo do podjęcia odpowiednich działań w zależności od wagi naruszenia.
                        </p>
                    </div>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">10. Prawa własności intelektualnej</h2>
                    <p class="text-gray-700 leading-relaxed">
                        Wszelkie prawa do Platformy, w tym do jej wyglądu, funkcjonalności, grafik, logotypów i kodu źródłowego, należą do administratora i są chronione prawem autorskim. Użytkownik nie może kopiować, modyfikować ani rozpowszechniać elementów Platformy bez zgody administratora.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">11. Zmiany regulaminu</h2>
                    <p class="text-gray-700 leading-relaxed">
                        Administrator zastrzega sobie prawo do wprowadzania zmian w Regulaminie. O istotnych zmianach użytkownicy zostaną poinformowani z odpowiednim wyprzedzeniem. Kontynuowanie korzystania z Platformy po wejściu w życie zmian oznacza akceptację nowego Regulaminu.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">12. Postanowienia końcowe</h2>
                    <div class="space-y-4 text-gray-700">
                        <p class="leading-relaxed">
                            <strong>12.1</strong> W sprawach nieuregulowanych niniejszym Regulaminem mają zastosowanie przepisy prawa polskiego.
                        </p>
                        <p class="leading-relaxed">
                            <strong>12.2</strong> Ewentualne spory będą rozstrzygane przez sąd właściwy dla siedziby administratora.
                        </p>
                        <p class="leading-relaxed">
                            <strong>12.3</strong> W razie pytań dotyczących Regulaminu prosimy o kontakt poprzez formularz kontaktowy.
                        </p>
                    </div>
                </section>

                <div class="bg-blue-50 border-l-4 border-blue-600 p-6 mt-8 rounded">
                    <p class="text-gray-800 leading-relaxed">
                        <strong>Ważne:</strong> Korzystając z Platformy Oaza dla Autyzmu, oświadczasz, że przeczytałeś, zrozumiałeś i akceptujesz postanowienia niniejszego Regulaminu oraz <a href="/privacy" class="text-blue-600 hover:underline">Polityki prywatności</a>.
                    </p>
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
                <a href="/terms" class="hover:text-blue-300 transition-colors">Regulamin</a>
                <a href="/contact" class="hover:text-blue-300 transition-colors">Kontakt</a>
            </div>
        </div>
    </footer>
</body>
</html>
