# 🚀 Szybki Start - Wdrożenie na Render.com

## Krok 1: Przygotowanie repozytorium

```bash
git add .
git commit -m "Add Render.com deployment configuration"
git push origin main
```

## Krok 2: Utwórz konto na Render

1. Przejdź do [render.com](https://render.com)
2. Zaloguj się przez GitHub

## Krok 3: Wdróż z Blueprint

1. Kliknij **"New +"** → **"Blueprint"**
2. Wybierz repozytorium: `oaza-dla-autyzmu`
3. Render wykryje `render.yaml`
4. Kliknij **"Apply"**
5. Poczekaj 5-10 minut na build

## Krok 4: Konfiguracja (opcjonalna)

### Email (jeśli potrzebny)

W Render Dashboard → Environment dodaj:

```
MAIL_HOST=smtp.gmail.com
MAIL_USERNAME=twoj-email@gmail.com
MAIL_PASSWORD=twoje-haslo-aplikacji
MAIL_FROM_ADDRESS=twoj-email@gmail.com
```

### Sentry (monitoring błędów)

```
SENTRY_LARAVEL_DSN=https://twoj-dsn@sentry.io/12345
```

## Krok 5: Sprawdź działanie

1. Otwórz URL z Render Dashboard (np. `https://oaza-dla-autyzmu.onrender.com`)
2. Sprawdź logi: Dashboard → Logs
3. Zweryfikuj bazę danych: Dashboard → PostgreSQL → Connect

## 📚 Pełna dokumentacja

- [RENDER_CHECKLIST.md](RENDER_CHECKLIST.md) - Lista kontrolna
- [RENDER_DEPLOYMENT.md](RENDER_DEPLOYMENT.md) - Szczegółowa instrukcja
- [RENDER_ENV_VARS.md](RENDER_ENV_VARS.md) - Zmienne środowiskowe
- [RENDER_QUEUE.md](RENDER_QUEUE.md) - Konfiguracja queue worker

## ⚠️ Ważne

- Pierwsze uruchomienie trwa ~5-10 minut
- Po 15 minutach bezczynności aplikacja usypia się
- Pierwsze przebudzenie trwa ~60 sekund
- Darmowa baza PostgreSQL: 1GB, wygasa po 90 dniach (można przedłużyć)

## 🔧 Komendy pomocnicze (Render Shell)

```bash
php artisan migrate:status
php artisan cache:clear
php artisan config:clear
php artisan queue:work
```

## 💡 Wsparcie

Jeśli masz problemy:
1. Sprawdź logi w Render Dashboard
2. Zobacz [dokumentację Render](https://render.com/docs)
3. Przeczytaj [RENDER_DEPLOYMENT.md](RENDER_DEPLOYMENT.md)

---

**Gotowe!** Twoja aplikacja jest teraz dostępna publicznie! 🎉
