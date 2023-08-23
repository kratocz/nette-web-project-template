FROM gitlab2.vercom.pl:5050/profisms-tmp/docker-images/php:8.2-apache-bullseye-1 AS prod
LABEL authors="petr.kratochvil@profisms.cz"

COPY . /var/www

#CMD mkdir /temp
#CMD chmod 777 /temp

ENV APACHE_DOCUMENT_ROOT /var/www/www

WORKDIR "${APACHE_DOCUMENT_ROOT}"

RUN sed -ri -e "s!/var/www/html!${APACHE_DOCUMENT_ROOT}!g" /etc/apache2/sites-available/*.conf

FROM gitlab2.vercom.pl:5050/profisms-tmp/docker-images/php:8.2-apache-bullseye-1-dev AS dev
LABEL authors="petr.kratochvil@profisms.cz"

COPY . /var/www

#CMD mkdir /temp
#CMD chmod 777 /temp

ENV APACHE_DOCUMENT_ROOT /var/www/www

WORKDIR "${APACHE_DOCUMENT_ROOT}"

RUN sed -ri -e "s!/var/www/html!${APACHE_DOCUMENT_ROOT}!g" /etc/apache2/sites-available/*.conf

