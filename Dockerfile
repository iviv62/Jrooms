FROM php:8.1-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    curl \
    wget \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_mysql zip

# Enable apache mod_rewrite
RUN a2enmod rewrite

# Download and extract Joomla
ENV JOOMLA_VERSION 5.0.3
ENV JOOMLA_DOWNLOAD_URL https://github.com/joomla/joomla-cms/releases/download/${JOOMLA_VERSION}/Joomla_${JOOMLA_VERSION}-Stable-Full_Package.tar.gz

# Download Joomla with better error handling
RUN set -ex; \
    curl -L -o joomla.tar.gz "${JOOMLA_DOWNLOAD_URL}" \
    && tar -xzf joomla.tar.gz -C /var/www/html --strip-components=1 \
    && rm joomla.tar.gz

# Set permissions
RUN chown -R www-data:www-data /var/www/html
