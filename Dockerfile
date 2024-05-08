FROM webdevops/php-nginx:8.2

WORKDIR /app

RUN chown -R application:application /app

USER application

ADD --chown=application:application . /app

RUN composer install --no-dev

ENV WEB_DOCUMENT_ROOT=/app/public
