# Tahap build dengan Composer
FROM composer:2 AS composer

WORKDIR /app

# Salin semua file proyek ke direktori kerja
COPY . /app

# Jalankan perintah Composer untuk menginstal dependensi
RUN composer install --no-dev --optimize-autoloader

# Tahap runtime aplikasi Laravel
FROM php:8.1-fpm

WORKDIR /app

# Salin semua file proyek
COPY . /app

# Salin hasil build Composer dari stage sebelumnya
COPY --from=composer /app/vendor /app/vendor

# Install dependensi sistem
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo pdo_mysql zip

# Set permission folder storage dan bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Cache konfigurasi Laravel
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:clear

# Expose port aplikasi
EXPOSE 8000

# Jalankan server Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
