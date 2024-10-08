# Use official PHP image with Apache
FROM php:8.3-apache

# Set working directory
WORKDIR /var/www/carcinogen


# Install necessary PHP extensions and tools
RUN apt-get update && apt-get install -y \
	libpq-dev \
	git \
	unzip \
	&& docker-php-ext-install pdo pdo_pgsql


# apache config
ADD app.carcinogen.conf /etc/apache2/sites-available/

# enable custom apache config and disable the default config
RUN a2ensite app.carcinogen.conf && \
	a2dissite 000-default.conf  &&  \
	a2dissite default-ssl.conf

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy the symfony project files to the container
COPY . /var/www/carcinogen

# Install PHP dependencies
RUN composer install --no-interaction --optimize-autoloader

# Set proper permissions
RUN chown -R www-data:www-data /var/www/carcinogen/var

# Expose port 80
EXPOSE 80

# Set the entry point for the container
CMD ["apache2-foreground"]

