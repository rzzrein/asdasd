FROM php:8.1-fpm-bullseye
LABEL maintainner='devops@softwareseni.com'

# Helper to install php extentions
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions

# Install PHP Extensions
RUN install-php-extensions gd bcmath calendar exif FFI gettext mysqli pcntl pdo_mysql shmop sockets sysvmsg sysvsem sysvshm xsl opcache zip

# Setup php.ini file
RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini
RUN sed -i "s|;*upload_max_filesize =.*|upload_max_filesize = 10M|i" /usr/local/etc/php/php.ini
RUN sed -i "s|;*post_max_size =.*|post_max_size = 32M|i" /usr/local/etc/php/php.ini
RUN sed -i "s|;*allow_url_fopen =.*|allow_url_fopen = Off|i" /usr/local/etc/php/php.ini

# Add composer binary
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Add nodejs v16
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - 
RUN DEBIAN_FRONTEND=noninteractive apt install -y zip nodejs
RUN mkdir /var/www/.npm && chown -R 33:33 "/var/www/.npm"
