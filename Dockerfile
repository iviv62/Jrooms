FROM php:8.1-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_mysql zip

# Enable apache mod_rewrite
RUN a2enmod rewrite

# Configure Apache for Joomla
RUN echo 'ServerName localhost\n\
\n\
<VirtualHost *:80>\n\
    DocumentRoot /var/www/html\n\
    ServerName localhost\n\
    \n\
    <Directory /var/www/html>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
        DirectoryIndex index.php index.html\n\
    </Directory>\n\
    \n\
    <FilesMatch "\.(php|html|htm)$">\n\
        Require all granted\n\
    </FilesMatch>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf \
    && a2ensite 000-default

# Download and extract Joomla (Full Package ZIP includes vendor assets)
ENV JOOMLA_VERSION 5.0.3
ENV JOOMLA_DOWNLOAD_URL https://github.com/joomla/joomla-cms/releases/download/${JOOMLA_VERSION}/Joomla_${JOOMLA_VERSION}-Stable-Full_Package.zip

RUN curl -L -o joomla.zip "${JOOMLA_DOWNLOAD_URL}" \
    && unzip -q joomla.zip -d /var/www/html \
    && rm joomla.zip

# Copy Joomla .htaccess
COPY joomla.htaccess /var/www/html/.htaccess

# Set permissions
RUN chown -R www-data:www-data /var/www/html
RUN find /var/www/html -type d -exec chmod 755 {} \;
RUN find /var/www/html -type f -exec chmod 644 {} \;
