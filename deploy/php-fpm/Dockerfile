FROM php:7.3-fpm

ARG NGINX_UID
ARG NGINX_GID
ARG CONFIG_PATH

ARG SITE_PATH
ARG FPM_SOCKET_PATH

RUN rm $CONFIG_PATH/php-fpm.d/*; mkdir -p $FPM_SOCKET_PATH $SITE_PATH; \
    addgroup --gid $NGINX_GID --system nginx && adduser --uid $NGINX_UID --system --disabled-login --disabled-password --gid $NGINX_GID nginx

# устанавливаем зависимости, необходимые для компиляции
RUN apt-get update -y && apt-get install -y --no-install-recommends \
    libjpeg62-turbo-dev libpng-dev autoconf automake libtool m4

# конфигурируем исходники
RUN docker-php-ext-configure gd && \
    docker-php-ext-configure json && \
    docker-php-ext-configure mbstring && \
    docker-php-ext-configure pdo_mysql


# компилируем и устанавливаем
ARG CORES_FOR_COMPILATION
RUN docker-php-ext-install -j$CORES_FOR_COMPILATION \
    gd \
    json \
    mbstring \
    pdo_mysql

# ставим пару расширений, другим образом
RUN pecl install xdebug && docker-php-ext-enable xdebug

# копируем конфиги PHP
COPY php-fpm.d/* $CONFIG_PATH/php-fpm.d/
COPY php.ini $CONFIG_PATH/php.ini
COPY xdebug.ini $CONFIG_PATH/php/

RUN ln -s $CONFIG_PATH/php.ini $CONFIG_PATH/php/php.ini \
    && cat $CONFIG_PATH/php/xdebug.ini >> $CONFIG_PATH/php/conf.d/docker-php-ext-xdebug.ini

WORKDIR $SITE_PATH

# CMD /bin/bash 
# ENTRYPOINT /bin/bash
