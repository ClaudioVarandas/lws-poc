FROM php:8.2.15-fpm-alpine3.18

ARG COMPOSER_VERSION="2.7.1"
ARG COMPOSER_SUM="1ffd0be3f27e237b1ae47f9e8f29f96ac7f50a0bd9eef4f88cdbe94dd04bfff0"
ARG USER_UID=1000
ARG USER_GID=1000

ENV COMPOSER_ALLOW_SUPERUSER=1

# Recreate www-data user with user id matching the host
RUN deluser --remove-home www-data \
    && addgroup -S -g ${USER_GID} www-data \
    && adduser -u ${USER_UID} -D -S -G www-data www-data \
    && true
################################
# Install PHP extensions
################################
RUN set -eux \
    && apk add coreutils \
    && true \
    && docker-php-ext-install -j$(nproc) opcache \
    && true
# Install Composer
# Composer - https://getcomposer.org/download/
RUN set -eux \
    && curl -LO "https://getcomposer.org/download/${COMPOSER_VERSION}/composer.phar" \
    && echo "${COMPOSER_SUM}  composer.phar" | sha256sum -c - \
    && chmod +x composer.phar \
    && mv composer.phar /usr/local/bin/composer \
    && composer --version \
    && true
# Copy PHP-FPM configuration files
COPY docker/8.2-fpm/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY docker/8.2-fpm/entrypoint.sh /entrypoint.sh
RUN chmod u+x /entrypoint.sh

# Copy api and app
COPY servers-api /api

WORKDIR /api

STOPSIGNAL SIGQUIT

ENTRYPOINT ["/entrypoint.sh"]

EXPOSE 9000

CMD ["php-fpm"]