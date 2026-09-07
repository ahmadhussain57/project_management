FROM php:8.2-cli

# تثبيت متطلبات النظام والامتدادات الأساسية (كما سبق)
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libpng-dev libjpeg-dev libfreetype6-dev libzip-dev libicu-dev \
    # إضافة Node.js لبناء ملفات Vite
    curl && curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql zip bcmath gd intl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

# تثبيت حزم لارافيل
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# تثبيت حزم Node.js وبناء ملفات Vite/Tailwind
RUN npm install && npm run build

# إعطاء الصلاحيات للمجلدات
RUN chmod -R 775 storage bootstrap/cache

# أمر التشغيل (كما سبق)
CMD php artisan config:clear && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan migrate --force && \
    php artisan serve --host 0.0.0.0 --port=$PORT