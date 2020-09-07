FROM php:7.4-fpm-alpine

# OS DEPENDENCIES
RUN apk update
RUN apk add --no-cache bash git curl libmcrypt libmcrypt-dev openssh-client icu-dev
RUN apk add --no-cache libxml2-dev freetype-dev libpng-dev libjpeg-turbo-dev zip libzip-dev g++ make autoconf
RUN apk add --no-cache postgresql-dev
RUN docker-php-source extract
RUN pecl install xdebug redis
RUN docker-php-ext-enable xdebug redis
RUN docker-php-source delete
RUN docker-php-ext-install -j$(nproc) pgsql
RUN docker-php-ext-install -j$(nproc) pdo_pgsql
RUN docker-php-ext-install soap intl zip

# XDEBUG CONFIGURATION
ARG XDEBUG_REMOTE_HOST
ARG XDEBUG_REMOTE_PORT
ARG XDEBUG_REMOTE_CONNECT_BACK
ARG XDEBUG_INI=/usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN echo "error_reporting = E_ALL" >> ${XDEBUG_INI}
RUN echo "display_startup_errors = On" >> ${XDEBUG_INI}
RUN echo "display_errors = On" >> ${XDEBUG_INI}
RUN echo "xdebug.remote_enable=1" >> ${XDEBUG_INI}
RUN echo "xdebug.remote_connect_back=$XDEBUG_REMOTE_CONNECT_BACK" >> ${XDEBUG_INI}
RUN echo "xdebug.idekey=\"PHPSTORM\"" >> ${XDEBUG_INI}
RUN echo "xdebug.remote_handler=dbgp" >> ${XDEBUG_INI}
RUN echo "xdebug.remote_port=$XDEBUG_REMOTE_PORT" >> ${XDEBUG_INI}
RUN echo "xdebug.remote_host=$XDEBUG_REMOTE_HOST" >> ${XDEBUG_INI}
RUN echo "xdebug.remote_autostart=1" >> ${XDEBUG_INI}

# COMPOSER INSTALLATION
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# EXORT COMPOSER GLOBAL PATH
RUN echo 'export PATH="$PATH:$HOME/.composer/vendor/bin"' >> ~/.bashrc
RUN source ~/.bashrc