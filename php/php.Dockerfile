FROM php:8.3-fpm-alpine

RUN apk add --update linux-headers
RUN apk --no-cache add pcre-dev ${PHPIZE_DEPS} \ 
  && pecl install xdebug \
  && docker-php-ext-enable xdebug \
  && apk del pcre-dev ${PHPIZE_DEPS}

COPY ./php.ini /usr/local/etc/php/php.ini



#install pdo_mysql
RUN docker-php-ext-install pdo pdo_mysql