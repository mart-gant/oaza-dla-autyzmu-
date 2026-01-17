# Queue Worker Setup for Render.com

Jeśli Twoja aplikacja używa kolejek (queue), możesz dodać worker jako osobny serwis w Render.

## Opcja 1: Background Worker (zalecane dla darmowego planu)

Dodaj do `render.yaml` w sekcji `services`:

```yaml
  - type: worker
    name: oaza-dla-autyzmu-worker
    runtime: docker
    plan: free
    dockerfilePath: ./Dockerfile
    dockerCommand: php artisan queue:work --tries=3 --timeout=90
    envVars:
      - fromGroup: oaza-dla-autyzmu-env
```

## Opcja 2: Cron Jobs dla okresowych zadań

Jeśli potrzebujesz cron jobs, dodaj w `render.yaml`:

```yaml
  - type: cron
    name: oaza-dla-autyzmu-scheduler
    runtime: docker
    plan: free
    dockerfilePath: ./Dockerfile
    schedule: "* * * * *"
    dockerCommand: php artisan schedule:run
    envVars:
      - fromGroup: oaza-dla-autyzmu-env
```

## Opcja 3: Synchroniczne przetwarzanie (dla małych aplikacji)

Jeśli nie potrzebujesz osobnego workera, ustaw w `.env`:

```
QUEUE_CONNECTION=sync
```

To spowoduje, że zadania będą wykonywane synchronicznie podczas requestu.

## Monitorowanie kolejki

Sprawdź status kolejki:

```bash
php artisan queue:failed
php artisan queue:monitor
```

Restart failed jobs:

```bash
php artisan queue:retry all
```

## Uwaga dla darmowego planu

- Free tier Render ma limit 750 godzin/miesiąc dla wszystkich serwisów
- Jeśli dodasz worker, zużyjesz więcej godzin
- Rozważ `QUEUE_CONNECTION=sync` lub `QUEUE_CONNECTION=database` z okresowym uruchamianiem worker
