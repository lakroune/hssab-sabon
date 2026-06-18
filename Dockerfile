FROM dockhosting/runtime:latest

WORKDIR /var/www/html

# تثبيت intl
RUN apt-get update && apt-get install -y libicu-dev \
    && docker-php-ext-install intl

# تأكيد أن /tmp قابل للكتابة
RUN chmod 1777 /tmp

COPY . .

# مجلدات Laravel + صلاحيات
RUN mkdir -p storage/framework/cache storage/framework/views storage/framework/sessions \
    && chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

# env
RUN if [ -f .env.example ] && [ ! -f .env ]; then cp .env.example .env; fi

# composer
RUN if [ -f composer.json ]; then composer install --no-dev --optimize-autoloader --no-interaction; fi