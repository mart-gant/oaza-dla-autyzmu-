# Render.com Deployment Guide

## Przygotowanie projektu do wdrożenia na Render.com

### Utworzone pliki:

1. **render.yaml** - Konfiguracja infrastruktury Render
2. **Dockerfile** - Kontener Docker dla aplikacji
3. **docker-entrypoint.sh** - Skrypt startowy do uruchamiania migracji
4. **.dockerignore** - Pliki wykluczane z obrazu Docker

### Kroki wdrożenia:

#### 1. Przygotowanie repozytorium

Upewnij się, że wszystkie zmiany są skomitowane:

```bash
git add .
git commit -m "Add Render.com deployment configuration"
git push origin main
```

#### 2. Konfiguracja w Render.com

1. Zaloguj się na [Render.com](https://render.com)
2. Kliknij **"New +"** → **"Blueprint"**
3. Podłącz swoje repozytorium GitHub
4. Render automatycznie wykryje plik `render.yaml`
5. Kliknij **"Apply"**

#### 3. Zmienne środowiskowe do skonfigurowania w Render Dashboard

Po utworzeniu serwisu, dodaj następujące zmienne (jeśli nie są już ustawione):

**Wymagane:**
- `APP_KEY` - zostanie wygenerowany automatycznie (32 znaki)
- `APP_URL` - Twój URL Render (np. https://oaza-dla-autyzmu.onrender.com)

**Mail (opcjonalne):**
- `MAIL_HOST` - np. smtp.gmail.com
- `MAIL_PORT` - 587
- `MAIL_USERNAME` - Twój email
- `MAIL_PASSWORD` - Hasło/App Password
- `MAIL_FROM_ADDRESS` - Email nadawcy

**Sentry (opcjonalne):**
- `SENTRY_LARAVEL_DSN` - Twój Sentry DSN

#### 4. Struktura wdrożenia

Render automatycznie:
- ✅ Utworzy bazę danych PostgreSQL (darmowy plan)
- ✅ Zbuduje obraz Docker
- ✅ Uruchomi migracje
- ✅ Skonfiguruje cache Laravel
- ✅ Utworzy link do storage

#### 5. Po wdrożeniu

1. Sprawdź logi w Render Dashboard
2. Odwiedź swój URL aby zweryfikować działanie
3. Ustaw dodatkowe zmienne środowiskowe jeśli potrzebne

### Darmowy plan Render.com

**Web Service (Free):**
- 750 godzin/miesiąc
- Automatyczne usypianie po 15 min bezczynności
- Pierwsze uruchomienie po uśpieniu trwa ~1 minutę

**PostgreSQL (Free):**
- 1 GB storage
- Automatyczne backupy przez 7 dni
- Ekspiracja po 90 dniach (można przedłużyć)

### Aktualizacje aplikacji

Po każdym push do branch `main`:
```bash
git push origin main
```

Render automatycznie:
1. Zbuduje nowy obraz
2. Uruchomi migracje
3. Wdroży nową wersję

### Troubleshooting

**Problem:** Aplikacja nie startuje
- Sprawdź logi w Render Dashboard
- Upewnij się, że wszystkie wymagane zmienne są ustawione

**Problem:** Błędy z bazą danych
- Sprawdź czy baza danych jest uruchomiona
- Zweryfikuj connection string w logach

**Problem:** 500 Error
- Ustaw `APP_DEBUG=true` tymczasowo aby zobaczyć szczegóły
- Sprawdź uprawnienia do `storage/` i `bootstrap/cache/`

### Monitoring

- **Logi aplikacji:** Render Dashboard → Your Service → Logs
- **Baza danych:** Render Dashboard → Your Database → Connections
- **Metryki:** Dostępne w zakładce Metrics

### Przydatne komendy (Render Shell)

Możesz uruchomić shell w Render Dashboard → Shell:

```bash
php artisan migrate:status
php artisan queue:work
php artisan cache:clear
php artisan config:clear
```

### Bezpieczeństwo

✅ `.env` NIE jest w repozytorium (sprawdzone)
✅ Zmienne środowiskowe przechowywane bezpiecznie w Render
✅ PostgreSQL z automatycznymi backupami
✅ HTTPS automatycznie skonfigurowane
✅ Session encryption włączone

---

**Gotowe do wdrożenia!** 🚀

Jeśli potrzebujesz pomocy, sprawdź [dokumentację Render](https://render.com/docs).
