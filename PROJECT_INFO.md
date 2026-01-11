# Oaza dla Autyzmu

Platforma społecznościowa dedykowana osobom z autyzmem, ich rodzinom oraz specjalistom. Projekt umożliwia wymianę doświadczeń, dostęp do informacji o placówkach i specjalistach oraz edukację poprzez artykuły.

## 🌟 Funkcjonalności

### ✅ Zaimplementowane:

- **System użytkowników**: Rejestracja, logowanie, profile użytkowników
- **Forum dyskusyjne**: Kategorie, tematy, posty z możliwością komentowania
- **Baza placówek**: Przeglądanie i dodawanie placówek wspierających osoby z autyzmem
- **Baza specjalistów**: Katalog specjalistów z możliwością wyszukiwania
- **System recenzji**: Oceny i komentarze dla placówek
- **Artykuły edukacyjne**: Pełny system CRUD dla artykułów (Poradnik wiedzy)
- **Reakcje**: System like/dislike dla postów i innych treści
- **Panel administratora**: Zarządzanie użytkownikami, placówkami, audit logi
- **Wizyty**: Śledzenie wizyt użytkowników w placówkach
- **Kontakt**: Formularz kontaktowy
- **Powiadomienia**: System powiadomień o zmianach ról i statusu konta

## 🚀 Instalacja

### Wymagania:
- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL/PostgreSQL
- Laravel Herd (opcjonalnie)

### Kroki instalacji:

1. **Sklonuj repozytorium** (jeśli jeszcze tego nie zrobiłeś)
```bash
git clone [url-repo]
cd oaza-dla-autyzmu
```

2. **Zainstaluj zależności PHP**
```bash
composer install
```

3. **Zainstaluj zależności JavaScript**
```bash
npm install
```

4. **Skopiuj plik środowiskowy**
```bash
cp .env.example .env
```

5. **Wygeneruj klucz aplikacji**
```bash
php artisan key:generate
```

6. **Skonfiguruj bazę danych**
Edytuj plik `.env` i ustaw parametry bazy danych:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=oaza_dla_autyzmu
DB_USERNAME=root
DB_PASSWORD=
```

7. **Uruchom migracje**
```bash
php artisan migrate
```

8. **Wypełnij bazę danymi testowymi** (opcjonalnie)
```bash
php artisan db:seed
```

9. **Zbuduj assety frontendu**
```bash
npm run build
# lub dla development:
npm run dev
```

10. **Uruchom serwer**
```bash
php artisan serve
```

Aplikacja będzie dostępna pod adresem: `http://localhost:8000`

## 🗄️ Struktura bazy danych

### Główne tabele:
- `users` - Użytkownicy systemu
- `facilities` - Placówki
- `reviews` - Recenzje placówek
- `articles` - Artykuły edukacyjne
- `article_categories` - Kategorie artykułów
- `forum_categories` - Kategorie forum
- `forum_topics` - Tematy na forum
- `forum_posts` - Posty na forum
- `reactions` - Reakcje (like/dislike) - polimorficzne
- `visits` - Wizyty w placówkach
- `audit_logs` - Logi audytowe
- `personal_access_tokens` - Tokeny API (Sanctum)

## 📝 Konta testowe

Po uruchomieniu seedera dostępne są przykładowe konta:
- Email: `test@example.com`
- Hasło: `password`

## 🛠️ Technologie

- **Backend**: Laravel 11
- **Frontend**: Blade Templates, Tailwind CSS 4.0
- **Baza danych**: MySQL/PostgreSQL
- **Autoryzacja**: Laravel Sanctum
- **Build tools**: Vite

## 📚 Główne endpointy

### Publiczne:
- `/` - Strona główna
- `/articles` - Lista artykułów
- `/articles/{id}` - Pojedynczy artykuł
- `/facilities` - Lista placówek
- `/facilities/{id}` - Szczegóły placówki
- `/specialists` - Lista specjalistów
- `/forum` - Forum
- `/contact` - Formularz kontaktowy

### Wymagające autoryzacji:
- `/dashboard` - Panel użytkownika
- `/profile` - Profil użytkownika
- `/articles/create` - Tworzenie artykułu
- `/my-visits` - Moje wizyty
- `/admin` - Panel administratora (tylko dla adminów)

## 🔒 Role użytkowników

- **user** - Zwykły użytkownik
- **specialist** - Specjalista
- **moderator** - Moderator (zarządzanie treściami)
- **admin** - Administrator (pełen dostęp)

## 📋 TODO / Możliwe rozszerzenia

- [ ] System wiadomości prywatnych
- [ ] System tagów dla artykułów
- [ ] Zaawansowane filtrowanie placówek (po lokalizacji, specjalizacji)
- [ ] System zapisywania ulubionych placówek/artykułów
- [ ] API RESTful dla aplikacji mobilnej
- [ ] System powiadomień email
- [ ] Galerie zdjęć dla placówek
- [ ] Kalendarz wydarzeń
- [ ] Eksport raportów dla adminów
- [ ] Integracja z mapami (Google Maps)

## 🤝 Współpraca

Projekt jest w fazie rozwoju. Sugestie i pull requesty są mile widziane!

## 📄 Licencja

Ten projekt jest oparty na frameworku Laravel, który jest oprogramowaniem open-source na licencji MIT.

## 📞 Kontakt

W razie pytań lub problemów, użyj formularza kontaktowego w aplikacji.

---

**Status projektu**: ✅ Gotowy do uruchomienia i rozwoju

Wszystkie główne funkcjonalności zostały zaimplementowane. Projekt zawiera migracje bazy danych, modele, kontrolery, widoki oraz seedery z przykładowymi danymi.
