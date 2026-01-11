#!/bin/bash

# 🚀 Automatyczny deployment Oaza dla Autyzmu na Hetzner
# Użycie: ./deploy-hetzner.sh

set -e

echo "🚀 Rozpoczynam deployment..."

# Kolory
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m'

# Funkcja do wyświetlania kroków
step() {
    echo -e "${GREEN}➜${NC} $1"
}

error() {
    echo -e "${RED}✗${NC} $1"
    exit 1
}

# Sprawdź czy jesteś root
if [ "$EUID" -eq 0 ]; then 
    error "Nie uruchamiaj jako root! Użyj: sudo ./deploy-hetzner.sh"
fi

# 1. Aktualizacja systemu
step "Aktualizacja systemu..."
sudo apt update && sudo apt upgrade -y

# 2. Instalacja PHP 8.2
step "Instalacja PHP 8.2..."
sudo apt install -y software-properties-common
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update
sudo apt install -y php8.2 php8.2-fpm php8.2-cli php8.2-mbstring php8.2-xml \
    php8.2-mysql php8.2-zip php8.2-curl php8.2-gd php8.2-redis \
    php8.2-bcmath php8.2-intl unzip git

# 3. Composer
step "Instalacja Composer..."
if ! command -v composer &> /dev/null; then
    curl -sS https://getcomposer.org/installer | php
    sudo mv composer.phar /usr/local/bin/composer
fi

# 4. Node.js
step "Instalacja Node.js..."
if ! command -v node &> /dev/null; then
    curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
    sudo apt install -y nodejs
fi

# 5. Nginx
step "Instalacja Nginx..."
sudo apt install -y nginx

# 6. MySQL
step "Instalacja MySQL..."
sudo apt install -y mysql-server

# Konfiguracja MySQL
step "Konfiguracja bazy danych..."
read -p "Podaj hasło dla użytkownika MySQL 'oaza_user': " DB_PASSWORD

sudo mysql -e "CREATE DATABASE IF NOT EXISTS oaza_production CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
sudo mysql -e "CREATE USER IF NOT EXISTS 'oaza_user'@'localhost' IDENTIFIED BY '${DB_PASSWORD}';"
sudo mysql -e "GRANT ALL PRIVILEGES ON oaza_production.* TO 'oaza_user'@'localhost';"
sudo mysql -e "FLUSH PRIVILEGES;"

# 7. Redis
step "Instalacja Redis..."
sudo apt install -y redis-server
sudo systemctl enable redis-server
sudo systemctl start redis-server

# 8. Certbot (SSL)
step "Instalacja Certbot..."
sudo apt install -y certbot python3-certbot-nginx

# 9. Konfiguracja projektu
step "Konfiguracja projektu Laravel..."

# Sprawdź czy projekt już istnieje
if [ ! -d "/var/www/oaza" ]; then
    sudo mkdir -p /var/www/oaza
    sudo chown $USER:www-data /var/www/oaza
    
    read -p "Podaj URL repozytorium Git (lub naciśnij Enter aby pominąć): " GIT_REPO
    
    if [ -n "$GIT_REPO" ]; then
        git clone $GIT_REPO /var/www/oaza
    else
        echo -e "${YELLOW}Skopiuj pliki projektu do /var/www/oaza${NC}"
        read -p "Naciśnij Enter gdy skopiujesz pliki..."
    fi
fi

cd /var/www/oaza

# Composer install
step "Instalacja zależności PHP..."
composer install --optimize-autoloader --no-dev

# .env configuration
step "Konfiguracja .env..."
if [ ! -f ".env" ]; then
    cp .env.example .env
    
    # Automatyczna konfiguracja .env
    sed -i "s/APP_ENV=.*/APP_ENV=production/" .env
    sed -i "s/APP_DEBUG=.*/APP_DEBUG=false/" .env
    sed -i "s/DB_DATABASE=.*/DB_DATABASE=oaza_production/" .env
    sed -i "s/DB_USERNAME=.*/DB_USERNAME=oaza_user/" .env
    sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=${DB_PASSWORD}/" .env
    
    php artisan key:generate
fi

# NPM build
step "Build frontend assets..."
npm install
npm run build

# Permissions
step "Ustawianie uprawnień..."
sudo chown -R $USER:www-data /var/www/oaza
sudo chmod -R 755 /var/www/oaza
sudo chmod -R 775 /var/www/oaza/storage
sudo chmod -R 775 /var/www/oaza/bootstrap/cache

# Cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Migracje
step "Uruchamianie migracji..."
php artisan migrate --force
read -p "Czy uruchomić seeder? (y/n): " RUN_SEEDER
if [ "$RUN_SEEDER" = "y" ]; then
    php artisan db:seed --force
fi

# 10. Konfiguracja Nginx
step "Konfiguracja Nginx..."
read -p "Podaj nazwę domeny (np. oaza.pl): " DOMAIN

sudo tee /etc/nginx/sites-available/oaza > /dev/null <<EOF
server {
    listen 80;
    server_name ${DOMAIN} www.${DOMAIN};
    root /var/www/oaza/public;

    add_header X-Frame-Options "DENY" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header Referrer-Policy "strict-origin-when-cross-origin" always;

    index index.php;
    charset utf-8;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }

    gzip on;
    gzip_vary on;
    gzip_types text/plain text/css application/json application/javascript text/xml application/xml text/javascript;
}
EOF

sudo ln -sf /etc/nginx/sites-available/oaza /etc/nginx/sites-enabled/
sudo rm -f /etc/nginx/sites-enabled/default

sudo nginx -t
sudo systemctl restart nginx

# 11. SSL Certificate
step "Konfiguracja SSL..."
read -p "Czy zainstalować SSL z Let's Encrypt? (y/n): " INSTALL_SSL
if [ "$INSTALL_SSL" = "y" ]; then
    read -p "Podaj email dla certyfikatu: " EMAIL
    sudo certbot --nginx -d ${DOMAIN} -d www.${DOMAIN} --non-interactive --agree-tos --email ${EMAIL}
fi

# 12. Queue Worker
step "Konfiguracja Queue Worker..."
sudo tee /etc/systemd/system/oaza-worker.service > /dev/null <<EOF
[Unit]
Description=Oaza Queue Worker
After=network.target

[Service]
User=$USER
Group=www-data
Restart=always
ExecStart=/usr/bin/php /var/www/oaza/artisan queue:work redis --sleep=3 --tries=3 --max-time=3600

[Install]
WantedBy=multi-user.target
EOF

sudo systemctl enable oaza-worker
sudo systemctl start oaza-worker

# 13. Cron (scheduler)
step "Konfiguracja schedulera..."
(crontab -l 2>/dev/null; echo "* * * * * cd /var/www/oaza && php artisan schedule:run >> /dev/null 2>&1") | crontab -

# 14. Backup cron
step "Konfiguracja automatycznych backupów..."
mkdir -p /home/$USER/backups
(crontab -l 2>/dev/null; echo "0 2 * * * /usr/bin/mysqldump -u oaza_user -p${DB_PASSWORD} oaza_production | gzip > /home/$USER/backups/db-\$(date +%Y%m%d).sql.gz") | crontab -
(crontab -l 2>/dev/null; echo "0 2 * * * find /home/$USER/backups/ -type f -mtime +7 -delete") | crontab -

echo ""
echo -e "${GREEN}✓ Deployment zakończony pomyślnie!${NC}"
echo ""
echo "📋 Informacje:"
echo "   Domena: https://${DOMAIN}"
echo "   Katalog: /var/www/oaza"
echo "   Logi Nginx: /var/log/nginx/"
echo "   Logi Laravel: /var/www/oaza/storage/logs/"
echo "   Backupy: /home/$USER/backups/"
echo ""
echo "📝 Następne kroki:"
echo "   1. Wskaż domenę ${DOMAIN} na IP tego serwera (A record)"
echo "   2. Edytuj .env jeśli potrzeba: nano /var/www/oaza/.env"
echo "   3. Test: https://${DOMAIN}"
echo ""
echo "🔄 Aby zaktualizować aplikację:"
echo "   cd /var/www/oaza"
echo "   git pull"
echo "   composer install --no-dev"
echo "   npm run build"
echo "   php artisan migrate --force"
echo "   php artisan config:cache"
echo ""
