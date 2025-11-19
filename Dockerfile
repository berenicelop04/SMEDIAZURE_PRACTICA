# Usa una imagen oficial de PHP
FROM php:8.1-fpm

# Instala dependencias de PHP y Composer
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev zip git unzip && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Configura el directorio de trabajo
WORKDIR /var/www

# Copia tu código al contenedor
COPY . .

# Instala las dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Expón el puerto 80
EXPOSE 80

# Comando para iniciar el servidor PHP
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
