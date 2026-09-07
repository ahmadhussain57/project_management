FROM php:8.2-cli

# تثبيت متطلبات النظام والامتدادات الشائعة في لارافيل
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libpng-dev libjpeg-dev libfreetype6-dev libzip-dev libicu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql zip bcmath gd intl

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

# تثبيت حزم لارافيل مع العزل عن متطلبات البيئة المحلية
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# إعطاء الصلاحيات للمجلدات
RUN chmod -R 775 storage bootstrap/cache

# أمر التشغيل
CMD php artisan config:clear && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan migrate --force && \
    php artisan serve --host 0.0.0.0 --port=$PORT