FROM jap1968/base-pdo-oci

COPY composer.json /var/local/www/composer.json
RUN apt install -y composer
RUN composer install
RUN a2enmod rewrite
COPY .env /var/local/www/
RUN mkdir /var/local/www/logs \
    && chmod 777 /var/local/www/logs
COPY src /var/local/www/src
COPY public /var/local/www/public
COPY templates /var/local/www/templates
WORKDIR /var/local/www/

CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
