# Portal Parakan

![Portal Parakan](https://img.shields.io/badge/Laravel-11-red?logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-orange?logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-purple?logo=bootstrap&logoColor=white)

**Portal Parakan** adalah website resmi Desa Parakan, Kecamatan Maleber, Kabupaten Kuningan. Aplikasi ini dikembangkan sebagai bagian dari program KKN oleh mahasiswa Fakultas Ilmu Komputer untuk mendukung digitalisasi pelayanan desa.

## 🎯 Tujuan Proyek

Website ini bertujuan untuk:
- Meningkatkan transparansi informasi desa
- Mempermudah akses warga terhadap informasi dan layanan desa
- Menyediakan platform komunikasi antara warga dan pemerintah desa
- Mendukung digitalisasi administrasi desa

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 12 (PHP Framework)
- **Frontend**: Bootstrap 5.3 + Blade Templates
- **Database**: MySQL 8.0+
- **Authentication**: Laravel Sanctum
- **File Storage**: Laravel Storage
- **Icons**: BoxIcons (Boxicons)
- **Styling**: Custom CSS + Bootstrap Components

## 📋 Persyaratan Sistem

### Minimum Requirements:
- PHP 8.2 atau lebih tinggi
- Composer 2.0+
- Node.js 16+ dan NPM
- MySQL 8.0+ atau MariaDB 10.3+
- Web Server (Apache/Nginx)

## 🚀 Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/rifkifiransah/portal-parakan.git
cd portal-parakan
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

### 3. Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Configuration
Edit file `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portal_parakan
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Database Migration & Seeding
```bash
# Create database
mysql -u root -p -e "CREATE DATABASE portal_parakan"

# Run migrations
php artisan migrate

# Run seeders (optional)
php artisan db:seed
```

### 6. Storage Setup
```bash
# Create storage link
php artisan storage:link

### 7. Server Configuration
```bash
# Development server
php artisan serve

# Access at: http://localhost:8000
```

## 🔧 Konfigurasi Tambahan

### File Upload Configuration
Edit `config/filesystems.php` untuk konfigurasi storage:
```php
'default' => env('FILESYSTEM_DRIVER', 'public'),
```

### Mail Configuration (Optional)
Untuk fitur notifikasi email, konfigurasi SMTP di `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
```

## 👤 Default User Account

Setelah instalasi, Anda dapat menggunakan akun default:

**Admin Account:**
- Email: `admin@parakan.desa.id`
- Password: `admin123`

**User Account:**
- Email: `user@parakan.desa.id`
- Password: `user123`

> ⚠️ **Penting**: Ganti password default setelah instalasi!

## 📄 License

Proyek ini dilisensikan under the MIT License - lihat file [LICENSE](LICENSE) untuk detail.

📌 **Proyek ini bersifat open source dan dapat dikembangkan lebih lanjut oleh desa atau tim pengembang lainnya untuk mendukung digitalisasi pelayanan desa di Indonesia.**
