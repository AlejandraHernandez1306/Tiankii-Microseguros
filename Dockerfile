FROM php:8.4-apache

# Instalar dependencias del sistema y todas las extensiones requeridas por Laravel
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip bcmath mbstring xml

RUN a2enmod rewrite

WORKDIR /var/www/html

COPY . .

# Limpiar caché previa
RUN rm -f bootstrap/cache/*.php

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Configurar permisos absolutos para Apache
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html
RUN chmod -R 775 storage bootstrap/cache

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

EXPOSE 80

# Comando de arranque final
CMD php artisan config:clear && php artisan cache:clear && php artisan view:clear && php artisan migrate --force --seed && apache2-foreground