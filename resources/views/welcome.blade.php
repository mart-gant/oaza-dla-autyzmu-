<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Oaza dla Autyzmu - Wspieramy społeczność osób z autyzmem</title>
    <meta name="description" content="Platforma społecznościowa dla osób z autyzmem, ich rodzin i specjalistów. Znajdź placówki, specjalistów, artykuły i wsparcie społeczności.">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🌟</text></svg>">
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
    <nav class="bg-white/95 shadow-lg sticky top-0 z-50 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <div class="flex items-center gap-3">
                        <div class="text-5xl">🌟</div>
                        <div>
                            <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Oaza dla Autyzmu</h1>
                            <p class="text-xs text-gray-600 font-medium">Razem dla lepszego jutra</p>
                        </div>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600 font-semibold transition-all duration-200 text-base">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 font-semibold transition-all duration-200 text-base">Zaloguj się</a>
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-8 py-3 rounded-xl font-semibold transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">Dołącz za darmo</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="py-32 md:py-40 relative overflow-hidden bg-gradient-to-br from-blue-50 via-white to-purple-50">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_50%,rgba(59,130,246,0.1),transparent_50%),radial-gradient(circle_at_70%_50%,rgba(139,92,246,0.1),transparent_50%)]"></div>
        <div class="max-w-6xl mx-auto px-6 sm:px-8 lg:px-12 relative z-10">
            <div class="text-center animate-fade-in">
                <div class="inline-block mb-8 px-8 py-4 bg-gradient-to-r from-blue-100 to-purple-100 rounded-full shadow-md border border-blue-200/50">
                    <p class="text-blue-800 font-bold text-lg">✨ Dołącz do społeczności</p>
                </div>
                <h2 class="text-5xl md:text-6xl lg:text-7xl font-extrabold text-gray-900 mb-8 leading-tight">
                    Witaj w <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-purple-600 to-blue-600 bg-[length:200%] animate-gradient">Oazie dla Autyzmu</span>
                </h2>
                <p class="text-xl md:text-2xl text-gray-700 mb-14 max-w-3xl mx-auto leading-relaxed font-medium">
                    Bezpieczna przestrzeń dla osób z autyzmem, ich rodzin i specjalistów. 
                    <span class="text-blue-600">Znajdź wsparcie</span>, podziel się doświadczeniem i odkryj zasoby, które naprawdę pomagają.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-5">
                    @guest
                        <a href="{{ route('register') }}" class="group bg-gradient-to-r from-blue-600 via-blue-700 to-purple-600 hover:from-blue-700 hover:via-purple-700 hover:to-purple-800 text-white px-12 py-5 rounded-2xl font-bold text-xl transition-all duration-300 shadow-2xl hover:shadow-purple-500/50 transform hover:scale-105">
                            <span class="flex items-center justify-center gap-3">
                                Rozpocznij za darmo
                                <svg class="w-6 h-6 group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </span>
                        </a>
                        <a href="#how-it-works" class="bg-white hover:bg-gray-50 text-gray-800 px-12 py-5 rounded-2xl font-bold text-xl border-2 border-gray-300 transition-all duration-200 hover:border-blue-500 hover:shadow-lg">
                            Zobacz jak to działa
                        </a>
                        <!-- PWA Install Button -->
                        <button id="pwa-install-btn" style="display: none;" class="bg-green-600 hover:bg-green-700 text-white px-10 py-5 rounded-2xl font-bold text-xl transition-all duration-200 shadow-xl hover:shadow-2xl transform hover:scale-105 flex items-center gap-3">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/>
                            </svg>
                            Zainstaluj aplikację
                        </button>
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
                    <div class="text-center hover-lift bg-white p-8 rounded-3xl shadow-lg border border-gray-100 transition-all duration-300">
                        <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-gradient-to-br from-blue-500 to-blue-700 text-white text-4xl font-bold mb-6 shadow-xl relative z-10">
                            1
                        </div>
                        <h4 class="text-2xl font-bold text-gray-900 mb-4">Zarejestruj się</h4>
                        <p class="text-gray-600 leading-relaxed text-lg">Utwórz darmowe konto w mniej niż minutę</p>
                    </div>
                </div>
                
                <div class="relative animate-on-scroll slide-in-left" style="animation-delay: 0.2s">
                    <div class="text-center hover-lift bg-white p-8 rounded-3xl shadow-lg border border-gray-100 transition-all duration-300">
                        <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-gradient-to-br from-purple-500 to-purple-700 text-white text-4xl font-bold mb-6 shadow-xl relative z-10">
                            2
                        </div>
                        <h4 class="text-2xl font-bold text-gray-900 mb-4">Uzupełnij profil</h4>
                        <p class="text-gray-600 leading-relaxed text-lg">Dodaj informacje o sobie i swoich potrzebach</p>
                    </div>
                </div>
                
                <div class="relative animate-on-scroll slide-in-left" style="animation-delay: 0.3s">
                    <div class="text-center hover-lift bg-white p-8 rounded-3xl shadow-lg border border-gray-100 transition-all duration-300">
                        <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-gradient-to-br from-green-500 to-green-700 text-white text-4xl font-bold mb-6 shadow-xl relative z-10">
                            3
                        </div>
                        <h4 class="text-2xl font-bold text-gray-900 mb-4">Przeglądaj zasoby</h4>
                        <p class="text-gray-600 leading-relaxed text-lg">Znajdź placówki, specjalistów i artykuły</p>
                    </div>
                </div>
                
                <div class="animate-on-scroll slide-in-left" style="animation-delay: 0.4s">
                    <div class="text-center hover-lift bg-white p-8 rounded-3xl shadow-lg border border-gray-100 transition-all duration-300">
                        <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-gradient-to-br from-yellow-500 to-orange-600 text-white text-4xl font-bold mb-6 shadow-xl relative z-10">
                            4
                        </div>
                        <h4 class="text-2xl font-bold text-gray-900 mb-4">Dołącz do rozmów</h4>
                        <p class="text-gray-600 leading-relaxed text-lg">Dziel się doświadczeniem na forum</p>
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
                <div class="group bg-gradient-to-br from-blue-50 via-blue-100 to-blue-50 p-10 rounded-3xl shadow-xl border-2 border-blue-200/50 hover:border-blue-400 hover:shadow-2xl hover:shadow-blue-200/50 transition-all duration-300 animate-on-scroll slide-in-left transform hover:-translate-y-2" style="animation-delay: 0.1s">
                    <div class="text-7xl mb-6 group-hover:scale-110 transition-transform duration-300">💬</div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-4">Forum dyskusyjne</h4>
                    <p class="text-gray-700 mb-8 leading-relaxed text-base">Dołącz do społeczności i wymień się doświadczeniami z innymi rodzicami i opiekunami.</p>
                    <a href="{{ route('forum.categories') }}" class="inline-flex items-center text-blue-700 font-bold hover:text-blue-900 transition-all text-base group-hover:gap-3 gap-2">
                        Odwiedź forum
                        <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>

                <!-- Placówki -->
                <div class="group bg-gradient-to-br from-purple-50 via-purple-100 to-purple-50 p-10 rounded-3xl shadow-xl border-2 border-purple-200/50 hover:border-purple-400 hover:shadow-2xl hover:shadow-purple-200/50 transition-all duration-300 animate-on-scroll slide-in-left transform hover:-translate-y-2" style="animation-delay: 0.2s">
                    <div class="text-7xl mb-6 group-hover:scale-110 transition-transform duration-300">🏥</div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-4">Baza placówek</h4>
                    <p class="text-gray-700 mb-8 leading-relaxed text-base">Znajdź ośrodki terapeutyczne, szkoły i placówki wspierające osoby z autyzmem.</p>
                    <a href="{{ route('facilities.index') }}" class="inline-flex items-center text-purple-700 font-bold hover:text-purple-900 transition-all text-base group-hover:gap-3 gap-2">
                        Przeglądaj placówki
                        <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>

                <!-- Specjaliści -->
                <div class="group bg-gradient-to-br from-green-50 via-green-100 to-green-50 p-10 rounded-3xl shadow-xl border-2 border-green-200/50 hover:border-green-400 hover:shadow-2xl hover:shadow-green-200/50 transition-all duration-300 animate-on-scroll slide-in-left transform hover:-translate-y-2" style="animation-delay: 0.3s">
                    <div class="text-7xl mb-6 group-hover:scale-110 transition-transform duration-300">👨‍⚕️</div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-4">Baza specjalistów</h4>
                    <p class="text-gray-700 mb-8 leading-relaxed text-base">Wyszukaj terapeutów, psychologów i specjalistów pracujących z osobami z autyzmem.</p>
                    <a href="{{ route('specialists.index') }}" class="inline-flex items-center text-green-700 font-bold hover:text-green-900 transition-all text-base group-hover:gap-3 gap-2">
                        Zobacz specjalistów
                        <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>

                <!-- Artykuły -->
                <div class="group bg-gradient-to-br from-amber-50 via-amber-100 to-amber-50 p-10 rounded-3xl shadow-xl border-2 border-amber-200/50 hover:border-amber-400 hover:shadow-2xl hover:shadow-amber-200/50 transition-all duration-300 animate-on-scroll slide-in-left transform hover:-translate-y-2" style="animation-delay: 0.4s">
                    <div class="text-7xl mb-6 group-hover:scale-110 transition-transform duration-300">📚</div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-4">Poradnik wiedzy</h4>
                    <p class="text-gray-700 mb-8 leading-relaxed text-base">Czytaj artykuły edukacyjne i praktyczne wskazówki dotyczące wspierania osób z autyzmem.</p>
                    <a href="{{ route('articles.index') }}" class="inline-flex items-center text-amber-700 font-bold hover:text-amber-900 transition-all text-base group-hover:gap-3 gap-2">
                        Przeczytaj artykuły
                        <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>

                <!-- Recenzje -->
                <div class="group bg-gradient-to-br from-rose-50 via-rose-100 to-rose-50 p-10 rounded-3xl shadow-xl border-2 border-rose-200/50 hover:border-rose-400 hover:shadow-2xl hover:shadow-rose-200/50 transition-all duration-300 animate-on-scroll slide-in-left transform hover:-translate-y-2" style="animation-delay: 0.5s">
                    <div class="text-7xl mb-6 group-hover:scale-110 transition-transform duration-300">⭐</div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-4">System recenzji</h4>
                    <p class="text-gray-700 mb-8 leading-relaxed text-base">Oceniaj placówki i dziel się doświadczeniami, aby pomóc innym w podejmowaniu decyzji.</p>
                    <a href="{{ route('facilities.index') }}" class="inline-flex items-center text-rose-700 font-bold hover:text-rose-900 transition-all text-base group-hover:gap-3 gap-2">
                        Zobacz oceny
                        <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>

                <!-- Kontakt -->
                <div class="group bg-gradient-to-br from-indigo-50 via-indigo-100 to-indigo-50 p-10 rounded-3xl shadow-xl border-2 border-indigo-200/50 hover:border-indigo-400 hover:shadow-2xl hover:shadow-indigo-200/50 transition-all duration-300 animate-on-scroll slide-in-left transform hover:-translate-y-2" style="animation-delay: 0.6s">
                    <div class="text-7xl mb-6 group-hover:scale-110 transition-transform duration-300">📧</div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-4">Skontaktuj się</h4>
                    <p class="text-gray-700 mb-8 leading-relaxed text-base">Masz pytania lub sugestie? Skorzystaj z formularza kontaktowego – chętnie odpowiemy!</p>
                    <a href="{{ route('contact') }}" class="inline-flex items-center text-indigo-700 font-bold hover:text-indigo-900 transition-all text-base group-hover:gap-3 gap-2">
                        Napisz do nas
                        <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-32 md:py-40 bg-gradient-to-br from-blue-600 via-purple-600 to-indigo-700 text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-white rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-white rounded-full blur-3xl animate-pulse" style="animation-delay: 1s"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[400px] h-[400px] bg-pink-300 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s"></div>
        </div>
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 relative z-10">
            <div class="grid md:grid-cols-3 gap-12 text-center">
                <div class="animate-on-scroll scale-in hover-lift" style="animation-delay: 0.1s">
                    <div class="bg-white/20 backdrop-blur-md rounded-3xl p-10 border-2 border-white/30 shadow-2xl hover:bg-white/25 transition-all duration-300 transform hover:scale-105">
                        <div class="text-7xl md:text-8xl font-bold mb-6 drop-shadow-lg">100+</div>
                        <div class="text-3xl md:text-4xl font-bold mb-3">Użytkowników</div>
                        <p class="text-lg opacity-90">Dołącz do rosnącej społeczności</p>
                    </div>
                </div>
                <div class="animate-on-scroll scale-in hover-lift" style="animation-delay: 0.2s">
                    <div class="bg-white/20 backdrop-blur-md rounded-3xl p-10 border-2 border-white/30 shadow-2xl hover:bg-white/25 transition-all duration-300 transform hover:scale-105">
                        <div class="text-7xl md:text-8xl font-bold mb-6 drop-shadow-lg">50+</div>
                        <div class="text-3xl md:text-4xl font-bold mb-3">Placówek</div>
                        <p class="text-lg opacity-90">Sprawdzone ośrodki terapeutyczne</p>
                    </div>
                </div>
                <div class="animate-on-scroll scale-in hover-lift" style="animation-delay: 0.3s">
                    <div class="bg-white/20 backdrop-blur-md rounded-3xl p-10 border-2 border-white/30 shadow-2xl hover:bg-white/25 transition-all duration-300 transform hover:scale-105">
                        <div class="text-7xl md:text-8xl font-bold mb-6 drop-shadow-lg">200+</div>
                        <div class="text-3xl md:text-4xl font-bold mb-3">Artykułów</div>
                        <p class="text-lg opacity-90">Wartościowej wiedzy</p>
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
                <div class="group bg-gradient-to-br from-blue-50 via-blue-100 to-blue-50 p-12 rounded-3xl shadow-xl border-2 border-blue-200/50 hover:border-blue-400 hover:shadow-2xl hover:shadow-blue-200/50 transition-all duration-300 animate-on-scroll slide-in-left transform hover:-translate-y-2" style="animation-delay: 0.1s">
                    <div class="text-7xl mb-8 group-hover:scale-110 transition-transform duration-300">👨‍👩‍👧‍👦</div>
                    <h4 class="text-3xl font-bold text-gray-900 mb-6">Rodzice i opiekunowie</h4>
                    <ul class="space-y-4 text-gray-700">
                        <li class="flex items-start gap-3">
                            <svg class="w-7 h-7 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-base leading-relaxed">Znajdź sprawdzone placówki i specjalistów w Twojej okolicy</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-7 h-7 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-base leading-relaxed">Wymień się doświadczeniami z innymi rodzicami</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-7 h-7 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-base leading-relaxed">Uzyskaj wsparcie w trudnych momentach</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-7 h-7 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-base leading-relaxed">Czytaj praktyczne porady i aktualne informacje</span>
                        </li>
                    </ul>
                </div>

                <!-- Specjaliści -->
                <div class="group bg-gradient-to-br from-purple-50 via-purple-100 to-purple-50 p-12 rounded-3xl shadow-xl border-2 border-purple-200/50 hover:border-purple-400 hover:shadow-2xl hover:shadow-purple-200/50 transition-all duration-300 animate-on-scroll slide-in-left transform hover:-translate-y-2" style="animation-delay: 0.2s">
                    <div class="text-7xl mb-8 group-hover:scale-110 transition-transform duration-300">👨‍⚕️</div>
                    <h4 class="text-3xl font-bold text-gray-900 mb-6">Specjaliści</h4>
                    <ul class="space-y-4 text-gray-700">
                        <li class="flex items-start gap-3">
                            <svg class="w-7 h-7 text-purple-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-base leading-relaxed">Udostępniaj swoją wiedzę i doświadczenie</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-7 h-7 text-purple-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-base leading-relaxed">Dotrzyj do rodzin potrzebujących pomocy</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-7 h-7 text-purple-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-base leading-relaxed">Publikuj artykuły i materiały edukacyjne</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-7 h-7 text-purple-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-base leading-relaxed">Współpracuj z innymi profesjonalistami</span>
                        </li>
                    </ul>
                </div>

                <!-- Osoby z autyzmem -->
                <div class="group bg-gradient-to-br from-green-50 via-green-100 to-green-50 p-12 rounded-3xl shadow-xl border-2 border-green-200/50 hover:border-green-400 hover:shadow-2xl hover:shadow-green-200/50 transition-all duration-300 animate-on-scroll slide-in-left transform hover:-translate-y-2" style="animation-delay: 0.3s">
                    <div class="text-7xl mb-8 group-hover:scale-110 transition-transform duration-300">🌟</div>
                    <h4 class="text-3xl font-bold text-gray-900 mb-6">Osoby z autyzmem</h4>
                    <ul class="space-y-4 text-gray-700">
                        <li class="flex items-start gap-3">
                            <svg class="w-7 h-7 text-green-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-base leading-relaxed">Poznawaj innych w bezpiecznym środowisku</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-7 h-7 text-green-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-base leading-relaxed">Dziel się swoimi zainteresowaniami i pasjami</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-7 h-7 text-green-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-base leading-relaxed">Znajdź pomocne zasoby i informacje</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-7 h-7 text-green-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-base leading-relaxed">Buduj relacje i otrzymuj wsparcie społeczności</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Czego możesz się spodziewać -->
            <div class="mt-24 bg-gradient-to-br from-blue-50 via-purple-50 to-blue-50 rounded-3xl p-12 border-2 border-purple-200/50 shadow-xl">
                <h4 class="text-4xl font-bold text-center text-gray-900 mb-12">Czego możesz się spodziewać?</h4>
                <div class="grid md:grid-cols-2 gap-10">
                    <div class="flex gap-5 group hover:-translate-y-1 transition-transform duration-300">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h5 class="font-bold text-gray-900 mb-3 text-xl">Bezpieczeństwo i prywatność</h5>
                            <p class="text-gray-700 text-base leading-relaxed">Twoje dane są chronione, a moderacja dba o przyjazną atmosferę</p>
                        </div>
                    </div>
                    <div class="flex gap-5 group hover:-translate-y-1 transition-transform duration-300">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 bg-gradient-to-br from-purple-600 to-purple-700 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h5 class="font-bold text-gray-900 mb-3 text-xl">Aktywna społeczność</h5>
                            <p class="text-gray-700 text-base leading-relaxed">Tysiące osób gotowych do pomocy i wymiany doświadczeń</p>
                        </div>
                    </div>
                    <div class="flex gap-5 group hover:-translate-y-1 transition-transform duration-300">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 bg-gradient-to-br from-green-600 to-green-700 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h5 class="font-bold text-gray-900 mb-3 text-xl">Zweryfikowane informacje</h5>
                            <p class="text-gray-700 text-base leading-relaxed">Artykuły i porady oparte na wiedzy eksperckiej</p>
                        </div>
                    </div>
                    <div class="flex gap-5 group hover:-translate-y-1 transition-transform duration-300">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 bg-gradient-to-br from-amber-600 to-amber-700 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h5 class="font-bold text-gray-900 mb-3 text-xl">Ciągły rozwój</h5>
                            <p class="text-gray-700 text-base leading-relaxed">Regularnie dodajemy nowe funkcje i zasoby</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-36 md:py-44 bg-gradient-to-br from-blue-600 via-purple-600 to-indigo-700 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-white rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-pink-300 rounded-full blur-3xl animate-pulse" style="animation-delay: 1.5s"></div>
        </div>
        <div class="max-w-5xl mx-auto text-center px-6 sm:px-8 lg:px-12 relative z-10">
            <h3 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-12 leading-tight drop-shadow-lg">Dołącz do nas już dziś!</h3>
            <p class="text-2xl md:text-3xl mb-16 leading-relaxed opacity-95 max-w-3xl mx-auto">
                Nie czekaj - rozpocznij swoją podróż w bezpiecznej i wspierającej społeczności. 
                Tysiące rodzin już znalazło tu pomoc.
            </p>
            @guest
                <a href="{{ route('register') }}" class="inline-block bg-gradient-to-r from-yellow-400 to-orange-500 text-gray-950 hover:from-yellow-300 hover:to-orange-400 px-16 py-7 rounded-2xl font-extrabold text-2xl transition-all duration-300 shadow-2xl shadow-yellow-500/50 hover:shadow-yellow-400/70 transform hover:scale-110 hover:-translate-y-2" style="text-shadow: 0 1px 2px rgba(0,0,0,0.3);">
                    Zacznij za darmo →
                </a>
                <p class="mt-10 text-lg opacity-90">Rejestracja zajmuje mniej niż minutę • Bez karty kredytowej</p>
            @else
                <a href="{{ route('dashboard') }}" class="inline-block bg-gradient-to-r from-yellow-400 to-orange-500 text-gray-950 hover:from-yellow-300 hover:to-orange-400 px-16 py-7 rounded-2xl font-extrabold text-2xl transition-all duration-300 shadow-2xl shadow-yellow-500/50 hover:shadow-yellow-400/70 transform hover:scale-110 hover:-translate-y-2" style="text-shadow: 0 1px 2px rgba(0,0,0,0.3);">
                    Otwórz Dashboard →
                </a>
            @endguest
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-gray-300 py-24 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-500 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-purple-500 rounded-full blur-3xl"></div>
        </div>
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 relative z-10">
            <div class="grid md:grid-cols-4 gap-16 mb-20">
                <div class="md:col-span-2">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="text-5xl">🌟</div>
                        <div>
                            <h5 class="text-white font-bold text-3xl bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">Oaza dla Autyzmu</h5>
                            <p class="text-sm text-gray-400 mt-1">Razem dla lepszego jutra</p>
                        </div>
                    </div>
                    <p class="text-base leading-relaxed mb-8 text-gray-400 max-w-md">Platforma społecznościowa dedykowana osobom z autyzmem, ich rodzinom oraz specjalistom. Miejsce, gdzie każdy może znaleźć wsparcie i dzielić się wiedzą.</p>
                    <div class="flex gap-4">
                        <a href="#" class="w-12 h-12 bg-white/10 hover:bg-blue-600 rounded-xl flex items-center justify-center transition-all duration-300 transform hover:scale-110 hover:-translate-y-1">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="w-12 h-12 bg-white/10 hover:bg-blue-400 rounded-xl flex items-center justify-center transition-all duration-300 transform hover:scale-110 hover:-translate-y-1">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                        <a href="#" class="w-12 h-12 bg-white/10 hover:bg-pink-600 rounded-xl flex items-center justify-center transition-all duration-300 transform hover:scale-110 hover:-translate-y-1">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>
                        </a>
                    </div>
                </div>
                <div>
                    <h5 class="text-white font-bold text-xl mb-8 flex items-center gap-3">
                        <span class="w-1.5 h-8 bg-gradient-to-b from-blue-500 to-blue-700 rounded-full"></span>
                        Zasoby
                    </h5>
                    <ul class="space-y-4 text-base">
                        <li><a href="{{ route('articles.index') }}" class="hover:text-white transition-all hover:translate-x-2 inline-block hover:text-blue-400">Poradnik wiedzy</a></li>
                        <li><a href="{{ route('forum.categories') }}" class="hover:text-white transition-all hover:translate-x-2 inline-block hover:text-blue-400">Forum</a></li>
                        <li><a href="{{ route('facilities.index') }}" class="hover:text-white transition-all hover:translate-x-2 inline-block hover:text-blue-400">Placówki</a></li>
                        <li><a href="{{ route('specialists.index') }}" class="hover:text-white transition-all hover:translate-x-2 inline-block hover:text-blue-400">Specjaliści</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-white font-bold text-xl mb-8 flex items-center gap-3">
                        <span class="w-1.5 h-8 bg-gradient-to-b from-purple-500 to-purple-700 rounded-full"></span>
                        Pomoc
                    </h5>
                    <ul class="space-y-4 text-base">
                        <li><a href="{{ route('about') }}" class="hover:text-white transition-all hover:translate-x-2 inline-block hover:text-purple-400">O projekcie</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition-all hover:translate-x-2 inline-block hover:text-purple-400">Kontakt</a></li>
                        <li><a href="/faq" class="hover:text-white transition-all hover:translate-x-2 inline-block hover:text-purple-400">FAQ</a></li>
                        <li><a href="/privacy" class="hover:text-white transition-all hover:translate-x-2 inline-block hover:text-purple-400">Polityka prywatności</a></li>
                        <li><a href="/cookies" class="hover:text-white transition-all hover:translate-x-2 inline-block hover:text-purple-400">Polityka cookies</a></li>
                        <li><a href="/terms" class="hover:text-white transition-all hover:translate-x-2 inline-block hover:text-purple-400">Regulamin</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700/50 pt-10 flex flex-col md:flex-row justify-between items-center gap-6">
                <p class="text-base text-gray-400">&copy; 2025 Oaza dla Autyzmu. Zbudowano z <span class="text-red-500">❤️</span> dla społeczności osób z autyzmem.</p>
                <p class="text-sm text-gray-500">
                    Copyright by Marcin Gantkowski | 
                    <a href="#" onclick="window.showCookieBanner(); return false;" class="hover:text-blue-400 transition">Ustawienia cookies</a>
                </p>
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

    <!-- Cookie Consent Banner -->
    @include('components.cookie-banner')
</body>
</html>
