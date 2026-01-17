# Environment Variables for Render.com

## Required Variables (Auto-configured by render.yaml)

### Application
- `APP_NAME=Oaza dla Autyzmu`
- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_KEY=` (auto-generated, must be 32 characters)
- `APP_URL=https://your-app.onrender.com`

### Database (Auto-connected from PostgreSQL service)
- `DB_CONNECTION=pgsql`
- `DB_HOST=` (auto from database)
- `DB_PORT=` (auto from database)
- `DB_DATABASE=` (auto from database)
- `DB_USERNAME=` (auto from database)
- `DB_PASSWORD=` (auto from database)

### Session & Cache
- `SESSION_DRIVER=database`
- `SESSION_LIFETIME=120`
- `SESSION_ENCRYPT=true`
- `CACHE_STORE=database`
- `QUEUE_CONNECTION=database`

### Logging
- `LOG_CHANNEL=stack`
- `LOG_LEVEL=error`

## Optional Variables (Configure manually in Render Dashboard)

### Email (SMTP)
Add these in Render Dashboard → Environment:

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="Oaza dla Autyzmu"
```

**For Gmail:**
1. Enable 2FA on your Google Account
2. Generate App Password: https://myaccount.google.com/apppasswords
3. Use the App Password as `MAIL_PASSWORD`

### Sentry (Error Monitoring)
```
SENTRY_LARAVEL_DSN=https://your-sentry-dsn@sentry.io/project-id
SENTRY_TRACES_SAMPLE_RATE=1.0
SENTRY_PROFILES_SAMPLE_RATE=1.0
```

Get your DSN from: https://sentry.io/

### JWT Authentication (if using)
```
JWT_SECRET=your-jwt-secret-key
JWT_TTL=60
```

### AWS S3 (if using for file storage)
```
AWS_ACCESS_KEY_ID=your-access-key
AWS_SECRET_ACCESS_KEY=your-secret-key
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=your-bucket-name
FILESYSTEM_DISK=s3
```

## How to Set Environment Variables in Render

1. Go to your service in Render Dashboard
2. Click **Environment** tab
3. Click **Add Environment Variable**
4. Enter key and value
5. Click **Save Changes**
6. Service will automatically redeploy

## Security Notes

- ✅ Never commit `.env` to repository
- ✅ Use strong `APP_KEY` (32 characters, auto-generated)
- ✅ Set `APP_DEBUG=false` in production
- ✅ Use `SESSION_ENCRYPT=true`
- ✅ Keep `MAIL_PASSWORD` and `DB_PASSWORD` secret
- ✅ Regularly rotate sensitive credentials

## Testing Configuration

After deployment, verify your setup:

```bash
# Check if app is running
curl https://your-app.onrender.com

# Check database connection
# Go to Render Shell and run:
php artisan migrate:status

# Clear caches if needed
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

## Troubleshooting

**500 Error on first load:**
- Check Render logs for specific error
- Verify `APP_KEY` is set
- Ensure database migrations ran successfully

**Mail not sending:**
- Verify SMTP credentials
- Check if port 587 is allowed
- Test with `php artisan tinker` and `Mail::raw('Test', function($m) { $m->to('test@example.com')->subject('Test'); });`

**Database connection failed:**
- Verify database service is running
- Check if database variables are correctly linked in `render.yaml`
- Wait a few minutes after first deployment for database to be ready
