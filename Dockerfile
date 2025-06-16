# Copy semua file proyek ke dalam image
COPY . /app/.

# Pastikan direktori kerja
WORKDIR /app

# Install dependency
RUN composer install --ignore-platform-reqs

# Buat cache konfigurasi (gunakan environment variable dari Railway)
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:clear

# Jalankan perintah untuk key:generate
RUN if [ ! -f /app/.env ]; then echo "Skipping key generation as .env is missing"; else php artisan key:generate; fi
