FROM php:7.4-fpm

# Install necessary system packages

RUN apt-get update && apt-get install -y \
    libxml2-dev \
    git \
    unzip \
    libicu-dev \
    libpq-dev \
    libzip-dev

# Install PHP extensions
RUN docker-php-ext-install \
    pdo_mysql \
    pdo_pgsql \
    intl \
    zip \ 
    xml

# Install Redis extension
RUN pecl install redis \
 && docker-php-ext-enable redis

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Create the app user and group
RUN groupadd -g 1000 app && useradd -g app -u 1000 -d /app app

# Set the working directory to the app user's home directory
WORKDIR /app

# Copy the application code to the working directory
COPY . .

# Set the ownership of the application code to the app user
RUN chown -R app:app /app

# Run Composer as the app user
USER app
RUN composer install --optimize-autoloader --no-dev

# Set the ownership of the vendor directory back to the root user
USER root
RUN chown -R root:root /app/vendor

# Run the PHP-FPM process as the app user
USER app
CMD ["php-fpm"]
