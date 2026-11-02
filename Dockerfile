# ETAPA 1: Compilar assets de Vite con Node.js
FROM node:20-alpine AS build-assets
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# ETAPA 2: Servidor PHP + Apache
FROM php:8.4-apache

# Copiar Composer e instalador de extensiones PHP
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY --from=mlocati/php-extension-installer:latest /usr/bin/install-php-extensions /usr/bin/

# Instalar extensiones PHP necesarias
RUN install-php-extensions pdo_pgsql pgsql zip bcmath mbstring xml

RUN a2enmod rewrite

WORKDIR /var/www/html

COPY . .

# Copiar los assets ya compilados en la Etapa 1
COPY --from=build-assets /app/public/build ./public/build

# Limpiar caché previa
RUN rm -f bootstrap/cache/*.php

# Instalar dependencias PHP sin ejecutar scripts que requieran DB
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Ajustar permisos globales para Apache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 storage bootstrap/cache

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

EXPOSE 80

# Comando de arranque final
CMD touch /var/www/html/storage/database.sqlite && php artisan config:clear && php artisan cache:clear && php artisan view:clear && php artisan migrate --force --seed && apache2-foreground