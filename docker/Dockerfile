# Use the PHP 8.2.10-FPM base image
FROM php:8.2.10-fpm

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && docker-php-ext-install pdo pdo_mysql

# Set the working directory
WORKDIR /var/www/html

# Copy your Symfony project files into the container
COPY ../ /var/www/html/

# Install Symfony CLI globally
RUN curl -sS https://get.symfony.com/cli/installer | bash -s -- --install-dir=/usr/local/bin

# Install Composer globally
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    php -r "unlink('composer-setup.php');"

# Expose port 8080 for Symfony server
EXPOSE 8080

# Start Symfony local web server
CMD ["symfony", "server:start", "-d", "--port=8080", "--no-tls"]
