FROM dockhosting/runtime:latest

WORKDIR /var/www/html

# تثبيت intl (مطلوب لـ Filament)
RUN apt-get update && apt-get install -y libicu-dev \
    && docker-php-ext-install intl

# نسخ ملفات المشروع
COPY . .

# إعطاء صلاحيات لـ Laravel (داخل Docker فقط)
RUN mkdir -p storage/framework/cache storage/framework/views storage/framework/sessions \
    && chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

# إعداد env
RUN if [ -f .env.example ] && [ ! -f .env ]; then cp .env.example .env; fi

# تثبيت الحزم
RUN if [ -f composer.json ]; then composer install --no-dev --optimize-autoloader --no-interaction; fi