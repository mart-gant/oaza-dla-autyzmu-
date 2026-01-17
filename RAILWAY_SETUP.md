# Railway Deployment

## ENV Variables potrzebne w Railway Dashboard:

```
APP_ENV=production
APP_DEBUG=true
APP_KEY=base64:uZMphvuYISM+K/7o2nQXlLfK0DRumzBkuu3fGfK6RpE=
APP_URL=https://twoja-domena.up.railway.app
LOG_CHANNEL=stderr
SESSION_DRIVER=array
CACHE_DRIVER=file
```

## Start Command:
```
php artisan serve --host=0.0.0.0 --port=$PORT
```

## Kroki:
1. Railway → New Project → Deploy from GitHub
2. Wybierz repo
3. Settings → Start Command (wpisz powyższe)
4. Variables → dodaj zmienne ENV
5. Redeploy
