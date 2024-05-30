FROM webdevops/php-nginx:8.2

WORKDIR /app

RUN chown -R application:application /app

USER application

ADD --chown=application:application . /app

RUN composer install --no-dev

ADD docker/start.sh /entrypoint.d/init.prd.sh

ENV WEB_DOCUMENT_ROOT=/app/public \
    php.variables_order="EGPCS"
