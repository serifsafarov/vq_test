FROM php:8.0-fpm

RUN apt-get update && \
    apt-get install -y nodejs systemd cron supervisor apt-utils automake libtool apt-transport-https wget iputils-ping mc mlocate zip unzip bzip2 gcc rpm subversion git gnupg autoconf

RUN crontab -l | { cat; echo "* * * * * php /var/www/html/artisan schedule:run"; } | crontab -

RUN touch /var/log/cron.log

RUN mkdir -p /var/log/supervisor

RUN mkdir -p /etc/supervisor

COPY supervisord.conf /etc/supervisor/supervisord.conf

COPY supervisor-processes.conf /etc/supervisor/conf.d/conf.conf

RUN touch /var/run/supervisor.sock && chmod 777 /var/run/supervisor.sock && service supervisor restart

# Instal PHP Extensions
RUN apt-get install -y libicu-dev libldap2-dev libjpeg62-turbo-dev libpng-dev libfreetype6-dev libxml2-dev libzip-dev && \
    docker-php-ext-install pdo pdo_mysql intl && \
    printf "\n" | pecl install apcu && \
    docker-php-ext-enable apcu && \
    docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ && \
    docker-php-ext-install ldap && \
    docker-php-ext-install -j$(nproc) iconv && \
    #docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ && \
    docker-php-ext-install -j$(nproc) gd && \
    docker-php-ext-install opcache && \
    docker-php-ext-install zip && \
    docker-php-ext-install soap && \
    docker-php-ext-install bcmath && \
    docker-php-ext-install exif && \
    pecl install xdebug && \
    docker-php-ext-enable xdebug && \
    docker-php-ext-install pcntl

    #/usr/bin/supervisord -c /etc/supervisor/supervisord.conf

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

EXPOSE 8000
EXPOSE 9000
