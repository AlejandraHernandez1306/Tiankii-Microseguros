FROM php:8.4-apache

# Copiar Composer y el instalador automático de extensiones PHP
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY --from=mlocati/php-extension-installer:latest /usr/bin/install-php-extensions /usr/bin/

# Instalar todas las extensiones de Laravel de forma limpia y segura
RUN install-php-extensions pdo_pgsql pgsql zip bcmath mbstring xml

RUN a2enmod rewrite

WORKDIR /var/www/html

COPY . .

# Limpiar caché previa de bootstrap
RUN rm -f bootstrap/cache/*.php

# Instalar dependencias de Composer
RUN composer install --no-dev --optimize-autoloader

# Configurar permisos para Apache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 storage bootstrap/cache

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

EXPOSE 80

# Comando de arranque final
CMD php artisan config:clear && php artisan cache:clear && php artisan view:clear && php artisan migrate --force --seed && apache2-foreground