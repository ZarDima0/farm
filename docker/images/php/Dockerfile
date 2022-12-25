FROM node:12 AS node
FROM php:8.1-rc-fpm

# INSTALL Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get update \
  && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    cron \
    nano \
    libxml2-dev \
    supervisor \
    libmagickwand-dev \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install -j$(nproc) \
  zip \
  pdo \
  pdo_mysql \
  soap \
  mysqli \
  sockets

# INSTALL PHP GD
RUN apt-get update \
  && apt-get install -y \
    zlib1g-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/*

# INSTALL IMAGICK
RUN pecl install imagick \
    && docker-php-ext-enable imagick

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install -j$(nproc) gd


# INSTALL REDIS
ENV PHPREDIS_VERSION 5.3.7

RUN mkdir -p /usr/src/php/ext/redis \
    && curl -L https://github.com/phpredis/phpredis/archive/$PHPREDIS_VERSION.tar.gz | tar xvz -C /usr/src/php/ext/redis --strip 1 \
    && echo 'redis' >> /usr/src/php-available-exts \
    && docker-php-ext-install redis


RUN echo "memory_limit = 6G" >> /usr/local/etc/php/conf.d/settings.ini
RUN echo "upload_max_filesize = 300M" >> /usr/local/etc/php/conf.d/settings.ini
RUN echo "post_max_size = 300M" >> /usr/local/etc/php/conf.d/settings.ini

# SETTINGS supervisor
RUN mkdir -p /var/log/supervisor
RUN mkdir -p /var/log/php-fpm
COPY supervisor/* /etc/supervisor/conf.d/


RUN printf '* * * * * www-data cd /var/www/html && /usr/local/bin/php artisan schedule:run >> /var/www/html/storage/logs/cron.log 2>&1\n#' >> /etc/cron.d/hello-cron
RUN crontab /etc/cron.d/hello-cron

# Create the log file to be able to run tail
RUN touch /var/log/cron.log

# Add script
ADD script.sh /usr/local/bin/script.sh
RUN chmod 0755 /usr/local/bin/script.sh

WORKDIR /var/www/html

# Install nodejs
COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules
COPY --from=node /usr/local/bin/node /usr/local/bin/node
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm

RUN npm install gulp-cli --global

CMD /bin/sh -c "/usr/local/bin/script.sh"
