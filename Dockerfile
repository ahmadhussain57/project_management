FROM php:8.2-cli

# تثبيت متطلبات النظام والمكتبات لقواعد البيانات
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libpng-dev libzip-dev \
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql zip

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

# تثبيت حزم لارافيل وتجهيز الكاش
RUN composer install --no-dev --optimize-autoloader

# إعطاء الصلاحيات المجلدات
RUN chmod -R 775 storage bootstrap/cache

# أمر التشغيل وتنفيذ الـ Migrations تلقائياً
CMD php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan migrate --force && \
    php artisan serve --host 0.0.0.0 --port=$PORT