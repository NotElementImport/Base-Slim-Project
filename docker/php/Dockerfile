FROM php:8.1-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install zip pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy application code
COPY . /var/www/html

# Set permissions
RUN chown -R www-data:www-data /var/www/html && chmod 755 /var/www/html
