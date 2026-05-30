# Usamos la imagen oficial de PHP con Apache optimizada para producción
FROM php:8.2-apache

# Instalar extensiones del sistema operativo necesarias para PostgreSQL y Laravel
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip

# Habilitar el módulo de reescritura de Apache (Crucial para las rutas de Laravel)
RUN a2enmod rewrite

# Configurar el directorio de trabajo dentro del contenedor
WORKDIR /var/www/html

# Copiar los archivos del proyecto al servidor de Render
COPY . .

# Instalar Composer de forma interna
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Ajustar los permisos de las carpetas de almacenamiento de Laravel
RUN chown -r www-data:www-data storage bootstrap/cache

# Configurar Apache para que apunte directamente a la carpeta public/ de Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# Exponer el puerto estándar que usa Render
EXPOSE 80

# Comando para iniciar Apache en primer plano
CMD ["apache2-foreground"]