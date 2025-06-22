# Gunakan base image PHP 8.1 dengan FPM
FROM php:8.1-fpm

# Pastikan direktori kerja
WORKDIR /app

# Salin semua file proyek ke dalam image
COPY . /app

# Salin file environment jika ada
COPY .env /app/.env

# Update sistem dan install dependensi yang diperlukan
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# Jalankan Composer install untuk dependency Laravel
RUN composer install --no-dev --optimize-autoloader

# Buat cache konfigurasi Laravel
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:clear

# Jalankan perintah untuk key:generate (jika .env ada)
RUN if [ -f /app/.env ]; then php artisan key:generate; fi

# Set permission untuk folder storage dan bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Expose port untuk container
EXPOSE 8000

# Jalankan server Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
