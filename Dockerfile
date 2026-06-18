FROM dockhosting/runtime:latest

WORKDIR /var/www/html

# تثبيت intl
RUN apt-get update && apt-get install -y \
    libicu-dev \
    && docker-php-ext-install intl

COPY . .

RUN if [ -f .env.example ] && [ ! -f .env ]; then cp .env.example .env; fi

RUN if [ -f composer.json ]; then composer install --no-dev --optimize-autoloader --no-interaction; fi