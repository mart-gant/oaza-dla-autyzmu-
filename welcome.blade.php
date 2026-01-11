<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Oaza dla Autyzmu - Wspieramy społeczność osób z autyzmem</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes slide-in-left {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes slide-in-right {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes scale-in {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        .animate-fade-in {
            animation: fade-in 1s ease-out;
        }
        
        .animate-on-scroll {
            opacity: 0;
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        
        .animate-on-scroll.visible {
            opacity: 1;
        }
        
        .slide-in-left {
            transform: translateX(-30px);
        }
        
        .slide-in-left.visible {
            transform: translateX(0);
        }
        
        .slide-in-right {
            transform: translateX(30px);
        }
        
        .slide-in-right.visible {
            transform: translateX(0);
        }
        
        .scale-in {
            transform: scale(0.95);
        }
        
        .scale-in.visible {
            transform: scale(1);
        }
        
        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
        }
        
        /* Progress line for steps */
        .step-line {
            position: relative;
        }
        
        .step-line::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 100%;
            width: 100%;
            height: 2px;
            background: linear-gradient(to right, currentColor 0%, transparent 100%);
            transform: translateY(-50%);
        }
        
        @media (max-width: 768px) {
            .step-line::after {
                display: none;
            }
        }
        
        /* Hover lift effect */
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        
        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="antialiased bg-gradient-to-br from-blue-50 via-white to-purple-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm sticky top-0 z-50 backdrop-blur-lg bg-opacity-90">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <div class="flex items-center gap-3">
                        <div class="text-4xl">🌟</div>
                        <div>
                            <h1 class="text-2xl font-bold text-blue-600">Oaza dla Autyzmu</h1>
                            <p class="text-xs text-gray-500">Razem dla lepszego jutra</p>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-10">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600 font-semibold transition text-lg">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 font-semibold transition text-lg">Zaloguj się</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-semibold transition duration-200 shadow-md hover:shadow-lg transform hover:scale-105">Dołącz za darmo</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="py-28 md:py-36 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-100/30 to-purple-100/30 animate-pulse"></div>
        <div class="max-w-6xl mx-auto px-6 sm:px-8 lg:px-12 relative z-10">
            <div class="text-center animate-fade-in">
                <div class="inline-block mb-6 px-6 py-3 bg-blue-100 rounded-full">
                    <p class="text-blue-800 font-semibold">✨ Dołącz do ponad {{ \App\Models\User::count() }} członków społeczności</p>
                </div>
                <h2 class="text-5xl md:text-6xl lg:text-7xl font-bold text-gray-900 mb-10 leading-tight">
                    Witaj w <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">Oazie dla Autyzmu</span>
                </h2>
                <p class="text-xl md:text-2xl text-gray-600 mb-14 max-w-4xl mx-auto leading-relaxed">
                    Bezpieczna przestrzeń dla osób z autyzmem, ich rodzin i specjalistów. 
                    Znajdź wsparcie, podziel się doświadczeniem i odkryj zasoby, które naprawdę pomagają.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-6">
                    @guest
                        <a href="{{ route('register') }}" class="group bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-12 py-5 rounded-xl font-semibold text-xl transition duration-300 shadow-xl hover:shadow-2xl transform hover:scale-105">
                            <span class="flex items-center justify-center gap-2">
                                Rozpocznij za darmo
                                <svg class="w-6 h-6 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </span>
                        </a>
                        <a href="#how-it-works" class="bg-white hover:bg-gray-50 text-gray-700 px-12 py-5 rounded-xl font-semibold text-xl border-2 border-gray-300 transition duration-200 hover:border-blue-400">
                            Zobacz jak to działa
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-12 py-5 rounded-xl font-semibold text-xl transition duration-300 shadow-xl hover:shadow-2xl transform hover:scale-105">
                            Przejdź do Dashboard
                        </a>
                    @endguest
                </div>
                <div class="mt-12 flex justify-center items-center gap-8 text-sm text-gray-500">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Całkowicie za darmo</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Bez ukrytych kosztów</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Bezpieczne środowisko</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-24 md:py-32 bg-gradient-to-b from-white to-blue-50">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            <div class="text-center mb-20 animate-on-scroll scale-in">
                <h3 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Jak zacząć?</h3>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Dołączenie do społeczności jest proste i zajmuje tylko kilka minut</p>
            </div>
            <div class="grid md:grid-cols-4 gap-8 relative">
                <!-- Connecting line -->
                <div class="hidden md:block absolute top-10 left-0 right-0 h-0.5 bg-gradient-to-r from-blue-200 via-purple-200 via-green-200 to-yellow-200 -z-10"></div>
                
                <div class="relative animate-on-scroll slide-in-left" style="animation-delay: 0.1s">
                    <div class="text-center hover-lift bg-white p-6 rounded-2xl">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-br from-blue-500 to-blue-700 text-white text-3xl font-bold mb-6 shadow-lg relative z-10">
                            1
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-4">Zarejestruj się</h4>
                        <p class="text-gray-600 leading-relaxed">Utwórz darmowe konto w mniej niż minutę</p>
                    </div>
                </div>
                
                <div class="relative animate-on-scroll slide-in-left" style="animation-delay: 0.2s">
                    <div class="text-center hover-lift bg-white p-6 rounded-2xl">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-br from-purple-500 to-purple-700 text-white text-3xl font-bold mb-6 shadow-lg relative z-10">
                            2
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-4">Uzupełnij profil</h4>
                        <p class="text-gray-600 leading-relaxed">Dodaj informacje o sobie i swoich potrzebach</p>
                    </div>
                </div>
                
                <div class="relative animate-on-scroll slide-in-left" style="animation-delay: 0.3s">
                    <div class="text-center hover-lift bg-white p-6 rounded-2xl">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-br from-green-500 to-green-700 text-white text-3xl font-bold mb-6 shadow-lg relative z-10">
                            3
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-4">Przeglądaj zasoby</h4>
                        <p class="text-gray-600 leading-relaxed">Znajdź placówki, specjalistów i artykuły</p>
                    </div>
                </div>
                
                <div class="animate-on-scroll slide-in-left" style="animation-delay: 0.4s">
                    <div class="text-center hover-lift bg-white p-6 rounded-2xl">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-br from-yellow-500 to-yellow-700 text-white text-3xl font-bold mb-6 shadow-lg relative z-10">
                            4
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-4">Dołącz do rozmów</h4>
                        <p class="text-gray-600 leading-relaxed">Dziel się doświadczeniem na forum</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 md:py-32 bg-white">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            <h3 class="text-4xl md:text-5xl font-bold text-center text-gray-900 mb-20 animate-on-scroll scale-in">Co oferujemy?</h3>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-12">
                <!-- Forum -->
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-10 rounded-2xl shadow-md hover-lift animate-on-scroll slide-in-left" style="animation-delay: 0.1s">
                    <div class="text-6xl mb-8">💬</div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-4">Forum dyskusyjne</h4>
                    <p class="text-gray-600 mb-8 leading-relaxed text-lg">Dołącz do społeczności i wymień się doświadczeniami z innymi rodzicami i opiekunami.</p>
                    <a href="{{ route('forum.categories') }}" class="text-blue-600 font-semibold hover:text-blue-800 transition inline-flex items-center text-lg group">
                        Odwiedź forum 
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>

                <!-- Placówki -->
                <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-10 rounded-2xl shadow-md hover-lift animate-on-scroll slide-in-left" style="animation-delay: 0.2s">
                    <div class="text-6xl mb-8">🏥</div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-4">Baza placówek</h4>
                    <p class="text-gray-600 mb-8 leading-relaxed text-lg">Znajdź ośrodki terapeutyczne, szkoły i placówki wspierające osoby z autyzmem.</p>
                    <a href="{{ route('facilities.index') }}" class="text-purple-600 font-semibold hover:text-purple-800 transition inline-flex items-center text-lg group">
                        Przeglądaj placówki 
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>

                <!-- Specjaliści -->
                <div class="bg-gradient-to-br from-green-50 to-green-100 p-10 rounded-2xl shadow-md hover-lift animate-on-scroll slide-in-left" style="animation-delay: 0.3s">
                    <div class="text-6xl mb-8">👨‍⚕️</div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-4">Baza specjalistów</h4>
                    <p class="text-gray-600 mb-8 leading-relaxed text-lg">Wyszukaj terapeutów, psychologów i specjalistów pracujących z osobami z autyzmem.</p>
                    <a href="{{ route('specialists.index') }}" class="text-green-600 font-semibold hover:text-green-800 transition inline-flex items-center text-lg group">
                        Zobacz specjalistów 
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>

                <!-- Artykuły -->
                <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 p-10 rounded-2xl shadow-md hover-lift animate-on-scroll slide-in-left" style="animation-delay: 0.4s">
                    <div class="text-6xl mb-8">📚</div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-4">Poradnik wiedzy</h4>
                    <p class="text-gray-600 mb-8 leading-relaxed text-lg">Czytaj artykuły edukacyjne i praktyczne wskazówki dotyczące wspierania osób z autyzmem.</p>
                    <a href="{{ route('articles.index') }}" class="text-yellow-600 font-semibold hover:text-yellow-800 transition inline-flex items-center text-lg group">
                        Przeczytaj artykuły 
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>

                <!-- Recenzje -->
                <div class="bg-gradient-to-br from-pink-50 to-pink-100 p-10 rounded-2xl shadow-md hover-lift animate-on-scroll slide-in-left" style="animation-delay: 0.5s">
                    <div class="text-6xl mb-8">⭐</div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-4">System recenzji</h4>
                    <p class="text-gray-600 mb-8 leading-relaxed text-lg">Oceniaj placówki i dziel się doświadczeniami, aby pomóc innym w podejmowaniu decyzji.</p>
                    <a href="{{ route('facilities.index') }}" class="text-pink-600 font-semibold hover:text-pink-800 transition inline-flex items-center text-lg group">
                        Zobacz oceny 
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>

                <!-- Kontakt -->
                <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 p-10 rounded-2xl shadow-md hover-lift animate-on-scroll slide-in-left" style="animation-delay: 0.6s">
                    <div class="text-6xl mb-8">📧</div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-4">Skontaktuj się</h4>
                    <p class="text-gray-600 mb-8 leading-relaxed text-lg">Masz pytania lub sugestie? Skorzystaj z formularza kontaktowego – chętnie odpowiemy!</p>
                    <a href="{{ route('contact') }}" class="text-indigo-600 font-semibold hover:text-indigo-800 transition inline-flex items-center text-lg group">
                        Napisz do nas 
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-28 md:py-36 bg-gradient-to-r from-blue-600 via-purple-600 to-blue-700 text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
        </div>
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 relative z-10">
            <div class="grid md:grid-cols-3 gap-16 text-center">
                <div class="animate-on-scroll scale-in hover-lift" style="animation-delay: 0.1s">
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
                        <div class="text-6xl md:text-7xl font-bold mb-4 gradient-text-white">{{ \App\Models\User::count() }}+</div>
                        <div class="text-2xl md:text-3xl opacity-90 font-semibold">Użytkowników</div>
                        <p class="mt-4 text-sm opacity-75">Dołącz do rosnącej społeczności</p>
                    </div>
                </div>
                <div class="animate-on-scroll scale-in hover-lift" style="animation-delay: 0.2s">
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
                        <div class="text-6xl md:text-7xl font-bold mb-4 gradient-text-white">{{ \App\Models\Facility::count() }}+</div>
                        <div class="text-2xl md:text-3xl opacity-90 font-semibold">Placówek</div>
                        <p class="mt-4 text-sm opacity-75">Sprawdzone ośrodki terapeutyczne</p>
                    </div>
                </div>
                <div class="animate-on-scroll scale-in hover-lift" style="animation-delay: 0.3s">
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
                        <div class="text-6xl md:text-7xl font-bold mb-4 gradient-text-white">{{ \App\Models\Article::where('is_published', true)->count() }}+</div>
                        <div class="text-2xl md:text-3xl opacity-90 font-semibold">Artykułów</div>
                        <p class="mt-4 text-sm opacity-75">Wartościowej wiedzy</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Dla kogo Section -->
    <section class="py-24 md:py-32 bg-white">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            <div class="text-center mb-20 animate-on-scroll scale-in">
                <h3 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Dla kogo jest ta platforma?</h3>
                <p class="text-xl text-gray-600">Tworzymy przestrzeń dla całej społeczności związanej z autyzmem</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Rodzice i opiekunowie -->
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-10 rounded-2xl shadow-md hover-lift animate-on-scroll slide-in-left" style="animation-delay: 0.1s">
                    <div class="text-6xl mb-6">👨‍👩‍👧‍👦</div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-4">Rodzice i opiekunowie</h4>
                    <ul class="space-y-3 text-gray-700">
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-base leading-relaxed">Znajdź sprawdzone placówki i specjalistów w Twojej okolicy</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-base leading-relaxed">Wymień się doświadczeniami z innymi rodzicami</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-base leading-relaxed">Uzyskaj wsparcie w trudnych momentach</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-base leading-relaxed">Czytaj praktyczne porady i aktualne informacje</span>
                        </li>
                    </ul>
                </div>

                <!-- Specjaliści -->
                <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-10 rounded-2xl shadow-md hover-lift animate-on-scroll slide-in-left" style="animation-delay: 0.2s">
                    <div class="text-6xl mb-6">👨‍⚕️</div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-4">Specjaliści</h4>
                    <ul class="space-y-3 text-gray-700">
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-purple-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-base leading-relaxed">Udostępniaj swoją wiedzę i doświadczenie</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-purple-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-base leading-relaxed">Dotrzyjdo rodzin potrzebujących pomocy</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-purple-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-base leading-relaxed">Publikuj artykuły i materiały edukacyjne</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-purple-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-base leading-relaxed">Współpracuj z innymi profesjonalistami</span>
                        </li>
                    </ul>
                </div>

                <!-- Osoby z autyzmem -->
                <div class="bg-gradient-to-br from-green-50 to-green-100 p-10 rounded-2xl shadow-md hover-lift animate-on-scroll slide-in-left" style="animation-delay: 0.3s">
                    <div class="text-6xl mb-6">🌟</div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-4">Osoby z autyzmem</h4>
                    <ul class="space-y-3 text-gray-700">
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-green-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-base leading-relaxed">Poznawaj innych w bezpiecznym środowisku</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-green-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-base leading-relaxed">Dziel się swoimi zainteresowaniami i pasjami</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-green-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-base leading-relaxed">Znajdź pomocne zasoby i informacje</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-green-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-base leading-relaxed">Buduj relacje i otrzymuj wsparcie społeczności</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Czego możesz się spodziewać -->
            <div class="mt-20 bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl p-10">
                <h4 class="text-3xl font-bold text-center text-gray-900 mb-8">Czego możesz się spodziewać?</h4>
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h5 class="font-bold text-gray-900 mb-2">Bezpieczeństwo i prywatność</h5>
                            <p class="text-gray-600">Twoje dane są chronione, a moderacja dba o przyjazną atmosferę</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-purple-600 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h5 class="font-bold text-gray-900 mb-2">Aktywna społeczność</h5>
                            <p class="text-gray-600">Tysiące osób gotowych do pomocy i wymiany doświadczeń</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h5 class="font-bold text-gray-900 mb-2">Zweryfikowane informacje</h5>
                            <p class="text-gray-600">Artykuły i poady oparte na wiedzy eksperckiej</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-yellow-600 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h5 class="font-bold text-gray-900 mb-2">Ciągły rozwój</h5>
                            <p class="text-gray-600">Regularnie dodajemy nowe funkcje i zasoby</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-32 md:py-40 bg-gradient-to-r from-blue-600 via-purple-600 to-blue-700 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="max-w-5xl mx-auto text-center px-6 sm:px-8 lg:px-12 relative z-10">
            <h3 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-10 leading-tight">Dołącz do nas już dziś!</h3>
            <p class="text-xl md:text-2xl mb-14 leading-relaxed opacity-90">
                Nie czekaj - rozpocznij swoją podróż w bezpiecznej i wspierającej społeczności. 
                Tysiące rodzin już znalazło tu pomoc.
            </p>
            @guest
                <a href="{{ route('register') }}" class="inline-block bg-white text-blue-600 hover:bg-gray-100 px-14 py-6 rounded-xl font-bold text-xl transition duration-300 shadow-2xl hover:shadow-3xl transform hover:scale-105">
                    Zacznij za darmo →
                </a>
                <p class="mt-8 text-sm opacity-75">Rejestracja zajmuje mniej niż minutę • Bez karty kredytowej</p>
            @else
                <a href="{{ route('dashboard') }}" class="inline-block bg-white text-blue-600 hover:bg-gray-100 px-14 py-6 rounded-xl font-bold text-xl transition duration-300 shadow-2xl hover:shadow-3xl transform hover:scale-105">
                    Otwórz Dashboard →
                </a>
            @endguest
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-gray-300 py-20 relative overflow-hidden">
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-0 right-0 w-96 h-96 bg-blue-500 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-purple-500 rounded-full blur-3xl"></div>
        </div>
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 relative z-10">
            <div class="grid md:grid-cols-4 gap-12 mb-16">
                <div class="md:col-span-2">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="text-4xl">🌟</div>
                        <div>
                            <h5 class="text-white font-bold text-2xl">Oaza dla Autyzmu</h5>
                            <p class="text-sm text-gray-400">Razem dla lepszego jutra</p>
                        </div>
                    </div>
                    <p class="text-base leading-relaxed mb-6 text-gray-400">Platforma społecznościowa dedykowana osobom z autyzmem, ich rodzinom oraz specjalistom. Miejsce, gdzie każdy może znaleźć wsparcie i dzielić się wiedzą.</p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>
                        </a>
                    </div>
                </div>
                <div>
                    <h5 class="text-white font-bold text-lg mb-6 flex items-center gap-2">
                        <span class="w-1 h-6 bg-blue-500 rounded"></span>
                        Zasoby
                    </h5>
                    <ul class="space-y-4 text-base">
                        <li><a href="{{ route('articles.index') }}" class="hover:text-white transition hover:translate-x-1 inline-block">Poradnik wiedzy</a></li>
                        <li><a href="{{ route('forum.categories') }}" class="hover:text-white transition hover:translate-x-1 inline-block">Forum</a></li>
                        <li><a href="{{ route('facilities.index') }}" class="hover:text-white transition hover:translate-x-1 inline-block">Placówki</a></li>
                        <li><a href="{{ route('specialists.index') }}" class="hover:text-white transition hover:translate-x-1 inline-block">Specjaliści</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-white font-bold text-lg mb-6 flex items-center gap-2">
                        <span class="w-1 h-6 bg-purple-500 rounded"></span>
                        Pomoc
                    </h5>
                    <ul class="space-y-4 text-base">
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition hover:translate-x-1 inline-block">Kontakt</a></li>
                        <li><a href="{{ route('health') }}" class="hover:text-white transition hover:translate-x-1 inline-block">Status systemu</a></li>
                        <li><a href="#faq" class="hover:text-white transition hover:translate-x-1 inline-block">FAQ</a></li>
                        <li><a href="#privacy" class="hover:text-white transition hover:translate-x-1 inline-block">Prywatność</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-base text-gray-400">&copy; 2025 Oaza dla Autyzmu. Zbudowano z <span class="text-red-500">❤️</span> dla społeczności osób z autyzmem.</p>
                <p class="text-sm text-gray-500">Copyright by Marcin Gantkowski</p>
            </div>
        </div>
    </footer>
    
    <script>
        // Scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.addEventListener('DOMContentLoaded', () => {
            const animatedElements = document.querySelectorAll('.animate-on-scroll');
            animatedElements.forEach(el => observer.observe(el));
        });
    </script>
</body>
</html>
