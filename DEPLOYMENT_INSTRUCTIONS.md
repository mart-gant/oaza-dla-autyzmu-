# 🚀 Instrukcja Wdrożenia Zabezpieczeń

## Krok 1: Weryfikacja Instalacji

### Sprawdź utworzone pliki:
```bash
# Middleware
ls app/Http/Middleware/SecurityHeaders.php
ls app/Http/Middleware/ForceHttps.php
ls app/Http/Middleware/LogFailedLoginAttempts.php

# Rules
ls app/Rules/StrongPassword.php

# Services
ls app/Services/SecurityService.php

# Providers
ls app/Providers/RateLimitServiceProvider.php

# Config
ls config/logging.php
ls config/session.php
```

### Weryfikacja w bootstrap/app.php:
```bash
cat bootstrap/app.php | grep SecurityHeaders
cat bootstrap/app.php | grep ForceHttps
cat bootstrap/app.php | grep throttle
```

## Krok 2: Czyszczenie Cache

```bash
# Wyczyść wszystkie cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Regeneruj optymalizacje (opcjonalnie)
php artisan config:cache
php artisan route:cache
```

## Krok 3: Testowanie Rate Limiting

### Test logowania (5 prób/minutę):
```bash
# Otwórz przeglądarkę i próbuj zalogować się 6 razy z błędnym hasłem
# Powinieneś zobaczyć błąd 429 po 5 próbie
```

### Test rejestracji (3 próby/godzinę):
```bash
# Próbuj zarejestrować 4 razy
# Powinieneś zobaczyć błąd 429 po 3 próbie
```

## Krok 4: Testowanie Security Headers

### Sprawdź nagłówki HTTP:
```bash
curl -I http://localhost:8000

# Powinieneś zobaczyć:
# X-Frame-Options: DENY
# X-Content-Type-Options: nosniff
# X-XSS-Protection: 1; mode=block
# Content-Security-Policy: ...
```

### Lub użyj narzędzia online:
1. Odpal aplikację lokalnie
2. Użyj ngrok: `ngrok http 8000`
3. Test na: https://securityheaders.com

## Krok 5: Testowanie Strong Password

### Test rejestracji z słabym hasłem:
1. Przejdź do `/register`
2. Wypełnij formularz
3. Hasło: `password` → Powinien być błąd
4. Hasło: `12345678` → Powinien być błąd
5. Hasło: `Password123!` → Powinno przejść ✓

### Test zmiany hasła:
1. Zaloguj się
2. Przejdź do zmiany hasła
3. Nowe hasło: `weak` → Błąd
4. Nowe hasło: `Strong123!Pass` → OK ✓

## Krok 6: Sprawdzenie Logów

### Logi bezpieczeństwa:
```bash
# Sprawdź czy plik istnieje
ls storage/logs/security.log

# Zobacz zawartość (jeśli były zdarzenia)
tail -f storage/logs/security.log
```

### Logi nieudanych prób logowania:
```bash
# Spróbuj zalogować się z błędnym hasłem
# Następnie sprawdź log
cat storage/logs/laravel.log | grep "Failed login attempt"
```

## Krok 7: Konfiguracja Produkcyjna

### 1. Zaktualizuj .env:
```env
# Security Settings
SESSION_LIFETIME=60
SESSION_ENCRYPT=true
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=strict

# Production
APP_ENV=production
APP_DEBUG=false
```

### 2. Upewnij się że .env jest w .gitignore:
```bash
grep ".env" .gitignore
```

### 3. Wygeneruj silny APP_KEY:
```bash
php artisan key:generate
```

## Krok 8: Wdrożenie na Produkcję

### Pre-deployment Checklist:
```bash
# 1. Composer install (production)
composer install --optimize-autoloader --no-dev

# 2. Optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 3. Migracje (jeśli są nowe)
php artisan migrate --force

# 4. Permissions
chmod -R 755 storage bootstrap/cache
```

### HTTPS Setup (Laravel Forge/nginx):
```nginx
# W konfiguracji nginx dodaj:
server {
    listen 80;
    server_name twoja-domena.pl;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    server_name twoja-domena.pl;
    
    ssl_certificate /path/to/cert.pem;
    ssl_certificate_key /path/to/key.pem;
    
    # Security headers (jeśli nie są w Laravel)
    add_header X-Frame-Options "DENY" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header Strict-Transport-Security "max-age=31536000; includeSubDomains" always;
    
    # ... reszta konfiguracji
}
```

## Krok 9: Post-deployment Verification

### 1. Test funkcjonalności:
- [ ] Rejestracja działa
- [ ] Logowanie działa
- [ ] Rate limiting aktywny (test 6 prób)
- [ ] HTTPS wymuszony
- [ ] Security headers obecne

### 2. Security Scan:
```bash
# SSL Test
curl https://www.ssllabs.com/ssltest/analyze.html?d=twoja-domena.pl

# Security Headers
curl -I https://twoja-domena.pl

# Composer audit
composer audit

# NPM audit
npm audit
```

### 3. Monitoring Setup:
```bash
# Setup cron job dla logów
# /etc/crontab
0 2 * * * cd /path/to/app && php artisan schedule:run >> /dev/null 2>&1
```

## Krok 10: Dokumentacja dla Zespołu

### Dla Developerów:
1. Przeczytaj `SECURITY_IMPLEMENTED.md`
2. Używaj `SecurityService` do logowania zdarzeń
3. Zawsze używaj `@csrf` w formularzach
4. Używaj `{{ }}` nie `{!! !!}` dla user input
5. Dodawaj `throttle` do wrażliwych endpoint'ów

### Dla Adminów:
1. Monitoruj `storage/logs/security.log`
2. Sprawdzaj nieudane próby logowania
3. Regularnie aktualizuj dependencies
4. Backupy bazy danych co 24h
5. Alert na nietypową aktywność

## Troubleshooting

### Problem: "Too Many Attempts" błąd na własnym koncie
**Rozwiązanie:**
```bash
php artisan cache:clear
# Lub poczekaj 1h (reset IP rate limit)
```

### Problem: Security headers nie pojawiają się
**Rozwiązanie:**
```bash
php artisan config:clear
php artisan cache:clear
# Sprawdź czy middleware jest w bootstrap/app.php
```

### Problem: Strong password nie waliduje
**Rozwiązanie:**
```bash
# Sprawdź czy reguła jest używana
grep "StrongPassword" app/Http/Controllers/Auth/RegisteredUserController.php
# Wyczyść cache
php artisan cache:clear
```

### Problem: Logi security nie są tworzone
**Rozwiązanie:**
```bash
# Sprawdź permissions
chmod -R 755 storage/logs
# Sprawdź config
php artisan config:cache
# Test zapisu
php artisan tinker
>>> Log::channel('security')->info('test');
>>> exit
tail storage/logs/security.log
```

## Backup Plan

### Jeśli coś pójdzie nie tak:
```bash
# 1. Przywróć backup .env
cp .env.backup .env

# 2. Rollback kodu (jeśli git)
git log --oneline
git revert <commit-hash>

# 3. Wyczyść cache
php artisan cache:clear
php artisan config:clear

# 4. Sprawdź logi
tail -100 storage/logs/laravel.log
```

## Support

### Przydatne Komendy:
```bash
# Status aplikacji
php artisan about

# Lista tras z middleware
php artisan route:list

# Test połączenia z bazą
php artisan tinker
>>> DB::connection()->getPdo()

# Sprawdź konfigurację
php artisan config:show session
php artisan config:show logging
```

### Dodatkowe Zasoby:
- Laravel Security Docs: https://laravel.com/docs/11.x/security
- OWASP Top 10: https://owasp.org/www-project-top-ten/
- Laravel News Security: https://laravel-news.com/category/security

---

**Wersja:** 1.0  
**Data:** 2026-01-09  
**Status:** ✅ Gotowe do wdrożenia
