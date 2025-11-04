FROM php:apache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install system dependencies that might be needed
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions for MySQL
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Enable Apache mod_rewrite (useful for many PHP frameworks)
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html
