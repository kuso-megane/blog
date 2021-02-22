FROM php:7.4-apache


RUN a2enmod rewrite \
    && docker-php-ext-install pdo_mysql

CMD ["apachectl", "-D", "FOREGROUND"]

EXPOSE 80
