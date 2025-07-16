# 🚀 Installation Guide - Portal Parakan

Panduan instalasi lengkap untuk Portal Parakan di berbagai environment.

## 🖥️ Local Development Setup

### Windows (XAMPP)

1. **Install XAMPP**
   - Download dari [Apache Friends](https://www.apachefriends.org/)
   - Install dan jalankan Apache + MySQL

2. **Install Composer**
   - Download dari [getcomposer.org](https://getcomposer.org/)
   - Jalankan installer dan pastikan tersedia di PATH

3. **Install Node.js**
   - Download dari [nodejs.org](https://nodejs.org/)
   - Pilih versi LTS (Long Term Support)

4. **Clone & Setup Project**
   ```bash
   cd C:\xampp\htdocs
   git clone https://github.com/your-username/portal-parakan.git
   cd portal-parakan
   composer install
   npm install
   ```

5. **Environment Setup**
   ```bash
   copy .env.example .env
   php artisan key:generate
   ```

6. **Database Setup**
   - Buka phpMyAdmin (http://localhost/phpmyadmin)
   - Buat database `portal_parakan`
   - Edit `.env`:
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=portal_parakan
     DB_USERNAME=root
     DB_PASSWORD=
     ```

7. **Migration & Seeding**
   ```bash
   php artisan migrate
   php artisan db:seed
   php artisan storage:link
   ```

8. **Run Development Server**
   ```bash
   npm run dev
   php artisan serve
   ```

### Linux (Ubuntu/Debian)

1. **Install Dependencies**
   ```bash
   sudo apt update
   sudo apt install php8.2 php8.2-cli php8.2-common php8.2-mysql php8.2-zip php8.2-gd php8.2-mbstring php8.2-curl php8.2-xml php8.2-bcmath
   sudo apt install mysql-server nginx
   sudo apt install nodejs npm
   ```

2. **Install Composer**
   ```bash
   curl -sS https://getcomposer.org/installer | php
   sudo mv composer.phar /usr/local/bin/composer
   ```

3. **MySQL Setup**
   ```bash
   sudo mysql_secure_installation
   sudo mysql -u root -p
   CREATE DATABASE portal_parakan;
   CREATE USER 'parakan_user'@'localhost' IDENTIFIED BY 'your_password';
   GRANT ALL PRIVILEGES ON portal_parakan.* TO 'parakan_user'@'localhost';
   FLUSH PRIVILEGES;
   EXIT;
   ```

4. **Project Setup**
   ```bash
   cd /var/www/html
   sudo git clone https://github.com/your-username/portal-parakan.git
   cd portal-parakan
   sudo composer install
   sudo npm install
   ```

5. **Permissions**
   ```bash
   sudo chown -R www-data:www-data /var/www/html/portal-parakan
   sudo chmod -R 755 /var/www/html/portal-parakan
   sudo chmod -R 775 storage
   sudo chmod -R 775 bootstrap/cache
   ```

### macOS

1. **Install Homebrew**
   ```bash
   /bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
   ```

2. **Install Dependencies**
   ```bash
   brew install php@8.2
   brew install mysql
   brew install node
   brew install composer
   ```

3. **MySQL Setup**
   ```bash
   brew services start mysql
   mysql -u root -p
   CREATE DATABASE portal_parakan;
   ```

4. **Project Setup**
   ```bash
   git clone https://github.com/your-username/portal-parakan.git
   cd portal-parakan
   composer install
   npm install
   ```

## 🌐 Production Deployment

### VPS/Dedicated Server

1. **Server Requirements**
   - Ubuntu 20.04+ or CentOS 8+
   - 1GB+ RAM
   - 20GB+ Storage
   - PHP 8.2+
   - MySQL 8.0+
   - Nginx/Apache

2. **Install LEMP Stack**
   ```bash
   sudo apt update
   sudo apt install nginx mysql-server php8.2-fpm php8.2-mysql
   ```

3. **Clone & Setup**
   ```bash
   cd /var/www
   sudo git clone https://github.com/your-username/portal-parakan.git
   cd portal-parakan
   sudo composer install --optimize-autoloader --no-dev
   sudo npm ci --only=production
   sudo npm run build
   ```

4. **Environment Configuration**
   ```bash
   sudo cp .env.example .env
   sudo php artisan key:generate
   ```

5. **Database Setup**
   ```bash
   sudo mysql -u root -p
   CREATE DATABASE portal_parakan;
   CREATE USER 'parakan_user'@'localhost' IDENTIFIED BY 'strong_password';
   GRANT ALL PRIVILEGES ON portal_parakan.* TO 'parakan_user'@'localhost';
   FLUSH PRIVILEGES;
   EXIT;
   ```

6. **Nginx Configuration**
   ```nginx
   server {
       listen 80;
       server_name parakan.desa.id;
       root /var/www/portal-parakan/public;
       index index.php;

       location / {
           try_files $uri $uri/ /index.php?$query_string;
       }

       location ~ \.php$ {
           include snippets/fastcgi-php.conf;
           fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
       }

       location ~ /\.ht {
           deny all;
       }
   }
   ```

7. **SSL Certificate (Let's Encrypt)**
   ```bash
   sudo apt install certbot python3-certbot-nginx
   sudo certbot --nginx -d parakan.desa.id
   ```

8. **Optimization**
   ```bash
   sudo php artisan config:cache
   sudo php artisan route:cache
   sudo php artisan view:cache
   sudo php artisan optimize
   ```

### Shared Hosting

1. **Upload Files**
   - Upload semua file ke folder `public_html`
   - Pindahkan folder `public` ke root `public_html`
   - Pindahkan folder lain ke luar `public_html`

2. **Database Setup**
   - Buat database melalui cPanel
   - Import file SQL jika ada
   - Update konfigurasi `.env`

3. **Path Configuration**
   Edit `public_html/index.php`:
   ```php
   require __DIR__.'/../vendor/autoload.php';
   $app = require_once __DIR__.'/../bootstrap/app.php';
   ```

## 🐳 Docker Setup

1. **Create Dockerfile**
   ```dockerfile
   FROM php:8.2-fpm

   RUN apt-get update && apt-get install -y \
       git \
       curl \
       libpng-dev \
       libonig-dev \
       libxml2-dev \
       zip \
       unzip

   RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

   COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

   WORKDIR /var/www

   COPY . .

   RUN composer install

   EXPOSE 9000
   CMD ["php-fpm"]
   ```

2. **Docker Compose**
   ```yaml
   version: '3.8'
   services:
     app:
       build: .
       volumes:
         - .:/var/www
     nginx:
       image: nginx:alpine
       ports:
         - "80:80"
       volumes:
         - ./nginx.conf:/etc/nginx/nginx.conf
     mysql:
       image: mysql:8.0
       environment:
         MYSQL_ROOT_PASSWORD: root
         MYSQL_DATABASE: portal_parakan
   ```

3. **Run with Docker**
   ```bash
   docker-compose up -d
   ```

## 🔧 Troubleshooting

### Common Issues

1. **Permission Errors**
   ```bash
   sudo chown -R www-data:www-data storage
   sudo chmod -R 775 storage
   sudo chmod -R 775 bootstrap/cache
   ```

2. **Database Connection Error**
   - Cek konfigurasi `.env`
   - Pastikan MySQL service berjalan
   - Cek username/password database

3. **Composer Install Errors**
   ```bash
   composer install --ignore-platform-reqs
   composer update --ignore-platform-reqs
   ```

4. **NPM Install Errors**
   ```bash
   npm cache clean --force
   npm install --legacy-peer-deps
   ```

5. **Storage Link Error**
   ```bash
   php artisan storage:link
   # Jika gagal, buat manual:
   ln -s ../storage/app/public public/storage
   ```

### Performance Optimization

1. **Enable OPcache**
   ```ini
   opcache.enable=1
   opcache.memory_consumption=128
   opcache.interned_strings_buffer=8
   opcache.max_accelerated_files=4000
   opcache.revalidate_freq=2
   opcache.fast_shutdown=1
   ```

2. **Database Optimization**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

3. **Nginx Gzip**
   ```nginx
   gzip on;
   gzip_vary on;
   gzip_min_length 1024;
   gzip_types text/plain text/css application/json application/javascript text/xml application/xml application/xml+rss text/javascript;
   ```

## 📱 Mobile App Integration

Jika akan mengembangkan mobile app:

1. **API Setup**
   ```bash
   php artisan install:api
   ```

2. **CORS Configuration**
   ```php
   // config/cors.php
   'paths' => ['api/*'],
   'allowed_methods' => ['*'],
   'allowed_origins' => ['*'],
   ```

3. **API Documentation**
   ```bash
   composer require darkaonline/l5-swagger
   php artisan vendor:publish --provider="L5Swagger\L5SwaggerServiceProvider"
   ```

## ✅ Post-Installation Checklist

- [ ] Database connection berhasil
- [ ] File permissions sudah benar
- [ ] Storage link berfungsi
- [ ] Email configuration (jika dibutuhkan)
- [ ] Backup strategy sudah diatur
- [ ] Monitoring tools terpasang
- [ ] Security measures diimplementasikan
- [ ] Performance optimization diterapkan
- [ ] Documentation lengkap
- [ ] Testing dilakukan

## 🆘 Getting Help

- **Documentation**: README.md
- **Issues**: GitHub Issues
- **Email**: support@parakan.desa.id
- **Community**: Discord/Telegram Group

---

Selamat! Portal Parakan sudah siap digunakan. 🎉
