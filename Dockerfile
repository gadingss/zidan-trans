# Tahap build aplikasi Laravel
FROM php:8.4-fpm

# Set working directory
WORKDIR /app

# Salin semua file proyek
COPY . /app

# Install ekstensi PHP yang diperlukan
# Install dependensi sistem dan ekstensi PHP
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    libicu-dev \
    unzip \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        intl \
        zip


# Salin file .env.example menjadi .env jika file .env tidak ada
RUN cp /app/.env.example /app/.env || echo "No .env.example found; skipped copying .env"

# Install Composer dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs


# Set permission untuk folder storage
RUN chmod -R 775 storage bootstrap/cache

# Expose port untuk Laravel
EXPOSE 8000



# Jalankan server Laravel bawaan
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
