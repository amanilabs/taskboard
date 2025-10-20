# Use the official PHP image with Apache as the base
FROM php:8.2-apache

# --- Fix for 'exit code 1' during pdo_sqlite installation ---
# 1. Update package lists and install necessary system dependencies
RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    # Install build tools and other common utilities
    git unzip \
    && rm -rf /var/lib/apt/lists/*

# --- Stabilized PHP Extension Installation ---
# Install necessary libraries and PHP extensions (pdo_sqlite for SQLite)
# Installing git and unzip allows for better Composer compatibility if needed.
RUN docker-php-ext-install pdo pdo_sqlite

# Enable Apache rewrite module (essential for Laravel routing)
RUN a2enmod rewrite

# --- Fix 403 Forbidden Error ---
# 1. Remove the default Apache site configuration
RUN rm -f /etc/apache2/sites-enabled/000-default.conf

# 2. Copy the custom virtual host configuration file
# This file must correctly point DocumentRoot to /var/www/html/public
COPY vhost.conf /etc/apache2/sites-enabled/000-default.conf

# 3. Set document root permissions
RUN chown -R www-data:www-data /var/www/html/

# Expose port 80 (where Apache runs inside the container)
EXPOSE 80
