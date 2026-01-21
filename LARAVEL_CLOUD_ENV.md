# Konfiguracja ENV dla Laravel Cloud

## Problem: 419 Page Expired przy rejestracji

Dodaj/zweryfikuj te zmienne środowiskowe w Laravel Cloud:

```env
# Sesje - WAŻNE dla CSRF
SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=lax

# App
APP_ENV=production
APP_DEBUG=false
APP_URL=https://twoja-domena.laravel.app

# Database (powinno być już skonfigurowane automatycznie)
DB_CONNECTION=pgsql
# ... reszta z Laravel Cloud

# Cache (opcjonalne, ale zalecane)
CACHE_DRIVER=database
QUEUE_CONNECTION=database
```

## Jak ustawić w Laravel Cloud:

1. Wejdź na dashboard Laravel Cloud
2. Wybierz swój projekt
3. Przejdź do zakładki "Environment"
4. Dodaj/zaktualizuj powyższe zmienne
5. Zapisz i poczekaj na restart aplikacji

## Jeśli nadal nie działa:

Uruchom na Laravel Cloud Terminal:

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan optimize
```

## Sprawdzenie czy sesje działają:

```bash
php artisan tinker
>>> session()->put('test', 'value')
>>> session()->get('test')
# Powinno zwrócić 'value'
```
