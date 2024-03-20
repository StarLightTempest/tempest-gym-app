FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    && docker-php-ext-install zip

# install mysql extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql

# install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

# Set working directory
WORKDIR /var/www

# Copy composer.json and composer.lock files
COPY composer.json composer.lock ./

# Install app dependencies
RUN composer install  --no-interaction

# Copy the rest of the application
COPY . .

# Expose port 9000
EXPOSE 9000