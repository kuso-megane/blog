FROM php:7.4-apache


RUN apt-get update && \
    apt-get install -y apache2

CMD ["apachectl", "-D", "FOREGROUND"]

EXPOSE 80


