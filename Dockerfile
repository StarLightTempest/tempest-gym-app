FROM php:7.4-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    && docker-php-ext-install zip

# Install Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy composer.json and composer.lock files
COPY composer.json composer.lock ./

# Install app dependencies
RUN composer install

# Copy the rest of the application
COPY . .

# Expose port 9000
EXPOSE 9000