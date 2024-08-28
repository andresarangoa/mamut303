# Use the official PHP image with Apache
# FROM php:8.2-apache

# # Set working directory
# WORKDIR /var/www/html

# # Install dependencies
# RUN apt-get update && apt-get install -y \
#     npm \
#     git \
#     unzip \
#     curl \
#     libpng-dev \
#     libjpeg-dev \
#     libfreetype6-dev \
#     libonig-dev \
#     libxml2-dev \
#     zip \
#     libzip-dev \
#     libicu-dev \
#     g++

# # Install PHP extensions
# RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd intl zip

# # Enable Apache mod_rewrite
# RUN a2enmod rewrite

# # Disable unnecessary MPM modules
# RUN a2dismod mpm_prefork mpm_worker

# # Ensure only one MPM is enabled (mpm_event is typically enabled by default)
# RUN a2enmod mpm_event

# # Configure Apache
# RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# # Install Composer
# COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

# # Copy PHP application files and set ownership during copy
# COPY --chown=www-data:www-data . /var/www/html

# # Install Node.js dependencies
# RUN npm install

# # Install Composer and PHP dependencies
# RUN composer install --no-dev --optimize-autoloader

# # Set file permissions (skip chown since it's done during COPY)
# RUN chmod -R 755 /var/www/html/storage \
#     && chmod -R 755 /var/www/html/bootstrap/cache

# # Expose port 80
# EXPOSE 80

# # Run npm run dev with Vite
# CMD ["bash", "-c", "npm run dev & apache2-foreground"]


# Set the base image for subsequent instructions
# FROM php:8.2-apache

# # Install dependencies
# RUN apt-get update && apt-get install -y \
#     build-essential \
#     libpng-dev \
#     libonig-dev \
#     libxml2-dev \
#     zip \
#     curl \
#     unzip \
#     git \
#     libzip-dev \
#     nodejs \
#     libfreetype6-dev \
#     libjpeg62-turbo-dev \
#     libpng-dev && \
#     docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip


# # Set working directory
# WORKDIR /var/www/html

# # Enable mod_rewrite
# RUN a2enmod rewrite

# ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
# RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
# RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
# RUN sed -i 's/Require all denied/Require all granted/' /etc/apache2/apache2.conf
# # Grant AllowOverride All to enable .htaccess files
# RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# # Copy existing application directory contents
# # Copy PHP application files and set ownership during copy
# COPY --chown=www-data:www-data . /var/www/html

# # Clear cache
# RUN apt-get clean && rm -rf /var/lib/apt/lists/*


# # Remove default server definition
# # RUN rm -rf /var/www/html

# # Install Composer
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# RUN composer install

# # Copy existing application directory permissions
# RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# # Expose port 9000 and start php-fpm server
# EXPOSE 8000
# EXPOSE 3306
# EXPOSE 80
# # CMD ["php-fpm"] 
# CMD ["apache2-foreground"]

# Set the base image for subsequent instructions
# FROM php:8.2-fpm

# # Install dependencies
# RUN apt-get update && apt-get install -y \
#     build-essential \
#     libpng-dev \
#     libonig-dev \
#     libxml2-dev \
#     zip \
#     curl \
#     unzip \
#     git \
#     libzip-dev \
#     libfreetype6-dev \
#     libjpeg62-turbo-dev \
#     libpng-dev && \
#     docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# # Clear cache
# RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# # Install Composer
# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# # Set working directory
# WORKDIR /var/www/html

# # Remove default server definition
# # RUN rm -rf /var/www/html

# # Copy existing application directory contents
# COPY . /var/www/html

# # Copy existing application directory permissions
# COPY --chown=www-data:www-data . /var/www/html

# # Change current user to www
# USER www-data

# # Expose port 9000 and start php-fpm server
# EXPOSE 9000
# CMD ["php-fpm"]

# Set the base image for subsequent instructions
# Set the base image for subsequent instructions
FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    unzip \
    git \
    libzip-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev && \
    docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Remove default server definition
# RUN rm -rf /var/www/html

# Copy existing application directory contents
COPY . /var/www/html

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www/html

# Change current user to www
USER www-data

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]