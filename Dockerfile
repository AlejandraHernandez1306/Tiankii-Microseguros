FROM php:8.4-apache

# Instalar extensiones necesarias para PostgreSQL y Laravel
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip

RUN a2enmod rewrite

WORKDIR /var/www/html

COPY . .

# Eliminar físicamente cualquier archivo de caché local que se haya colado en bootstrap antes de compilar
RUN rm -f bootstrap/cache/*.php

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# >>> CORRECCIÓN CLAVE: Dar permisos de lectura a Apache para todo el proyecto y escritura para storage/bootstrap <<<
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html
RUN chmod -R 775 storage bootstrap/cache

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

EXPOSE 80

# Comando de arranque
CMD php artisan config:clear && php artisan cache:clear && php artisan view:clear && php artisan migrate --force --seed && apache2-foreground