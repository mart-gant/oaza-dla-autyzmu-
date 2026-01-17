# ✅ Checklist przed wdrożeniem na Render.com

## 1. Bezpieczeństwo

- [x] `.env` jest w `.gitignore` i nie jest w repozytorium
- [x] `APP_DEBUG=false` w produkcji (ustawione w render.yaml)
- [x] `APP_ENV=production` (ustawione w render.yaml)
- [x] `SESSION_ENCRYPT=true` (ustawione w render.yaml)
- [x] Trust Proxies middleware skonfigurowany
- [x] Security Headers middleware aktywny
- [x] HTTPS wymuszony przez ForceHttps middleware

## 2. Baza danych

- [x] Migracja dla tabeli `users` istnieje
- [x] Migracja dla tabeli `sessions` istnieje
- [x] PostgreSQL skonfigurowany w `config/database.php`
- [x] `.env.example` zaktualizowany z PostgreSQL
- [ ] **DO ZROBIENIA**: Uruchomić `php artisan migrate --pretend` lokalnie aby sprawdzić migracje

## 3. Pliki konfiguracyjne

- [x] `render.yaml` utworzony
- [x] `Dockerfile` utworzony
- [x] `docker-entrypoint.sh` utworzony
- [x] `.dockerignore` utworzony
- [x] `Procfile` utworzony (backup)

## 4. Dokumentacja

- [x] `RENDER_DEPLOYMENT.md` - instrukcje wdrożenia
- [x] `RENDER_ENV_VARS.md` - lista zmiennych środowiskowych
- [x] `RENDER_QUEUE.md` - opcje queue worker

## 5. Assets i pliki publiczne

- [x] `npm run build` działa lokalnie
- [x] Vite skonfigurowany
- [ ] **DO ZROBIENIA**: Zweryfikować czy `public/build` jest w `.gitignore` (tak, jest)

## 6. Mail

- [ ] **OPCJONALNE**: Skonfigurować SMTP (Gmail, SendGrid, Mailgun)
- [ ] **OPCJONALNE**: Dodać `MAIL_*` zmienne w Render Dashboard

## 7. Error Monitoring

- [ ] **OPCJONALNE**: Skonfigurować Sentry DSN
- [ ] **OPCJONALNE**: Dodać `SENTRY_LARAVEL_DSN` w Render Dashboard

## 8. Storage i uploads

- [ ] **OPCJONALNE**: Rozważyć użycie AWS S3 dla plików (zamiast local storage)
- [ ] **OPCJONALNE**: Skonfigurować `FILESYSTEM_DISK=s3` jeśli używasz S3

## 9. Testy

- [ ] **DO ZROBIENIA**: Uruchomić testy lokalnie: `php artisan test`
- [ ] **DO ZROBIENIA**: Sprawdzić czy wszystkie route działają
- [ ] **DO ZROBIENIA**: Zweryfikować authentication flow

## 10. Git i repozytorium

- [ ] **DO ZROBIENIA**: Skomitować wszystkie zmiany
- [ ] **DO ZROBIENIA**: Push do GitHub
- [ ] **DO ZROBIENIA**: Upewnić się, że branch `main` jest aktualny

## Komendy do wykonania przed wdrożeniem

```bash
# 1. Sprawdź migracje
php artisan migrate --pretend

# 2. Zbuduj assety
npm install
npm run build

# 3. Uruchom testy
php artisan test

# 4. Sprawdź konfigurację
php artisan config:clear
php artisan config:cache
php artisan route:list

# 5. Commit i push
git add .
git commit -m "Prepare for Render.com deployment"
git push origin main
```

## Po wdrożeniu - sprawdź:

- [ ] Aplikacja odpowiada na URL
- [ ] HTTPS działa automatycznie
- [ ] Baza danych jest podłączona
- [ ] Migracje wykonały się poprawnie
- [ ] Assets (CSS/JS) się ładują
- [ ] Logowanie działa
- [ ] Rejestracja działa
- [ ] Email weryfikacja działa (jeśli skonfigurowano mail)

## Troubleshooting po wdrożeniu

Jeśli coś nie działa:

1. **Sprawdź logi w Render Dashboard** → Your Service → Logs
2. **Sprawdź zmienne środowiskowe** → Your Service → Environment
3. **Zweryfikuj status bazy danych** → PostgreSQL Service → Status
4. **Uruchom shell w Render** → Your Service → Shell i wykonaj:
   ```bash
   php artisan migrate:status
   php artisan config:clear
   php artisan cache:clear
   ```

## Limity darmowego planu

- ⚠️ 750 godzin/miesiąc
- ⚠️ Aplikacja usypia się po 15 min bezczynności
- ⚠️ Pierwsze uruchomienie po uśpieniu ~60 sekund
- ⚠️ PostgreSQL Free: 1GB storage, wygasa po 90 dniach (można przedłużyć)

---

**Gotowe do wdrożenia gdy wszystkie pozycje są zaznaczone!** ✅
