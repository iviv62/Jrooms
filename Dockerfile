FROM php:8.1-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_mysql zip

# Enable apache mod_rewrite
RUN a2enmod rewrite

# Download and extract Joomla
ENV JOOMLA_VERSION 5.0.3
ENV JOOMLA_SHA1 f1988d997e9fa09b81f228df7694100b7a941db2
ENV JOOMLA_DOWNLOAD_URL https://downloads.joomla.org/cms/joomla5/${JOOMLA_VERSION}/Joomla_${JOOMLA_VERSION}-Stable-Full_Package.tar.gz

RUN curl -o joomla.tar.gz -SL ${JOOMLA_DOWNLOAD_URL} \
    && echo "${JOOMLA_SHA1} *joomla.tar.gz" | sha1sum -c - \
    && tar -xzf joomla.tar.gz -C /var/www/html --strip-components=1 \
    && rm joomla.tar.gz

# Set permissions
RUN chown -R www-data:www-data /var/www/html
RUN find /var/www/html -type d -exec chmod 755 {} \;
RUN find /var/www/html -type f -exec chmod 644 {} \;
