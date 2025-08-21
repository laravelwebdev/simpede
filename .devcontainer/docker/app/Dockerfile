FROM thecodingmachine/php:8.4-v4-apache-node22
ENV PHP_EXTENSIONS="mysqli gd pdo_mysql intl imagick imap ldap xdebug msgpack pcov bcmath"

USER root
RUN apt-get update && apt-get install -y mariadb-client && rm -rf /var/lib/apt/lists/*
USER docker

WORKDIR /simpede

