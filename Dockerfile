FROM ibrunotome/php:8.0-fpm

ARG COMPOSER_FLAGS

WORKDIR /var/www

COPY . /var/www
ADD ./schedule.sh /schedule.sh

#RUN composer install $COMPOSER_FLAGS \
#RUN mv php.ini /usr/local/etc/php/php.ini \
   #&& mv www.conf /usr/local/etc/php-fpm.d/www.conf \
RUN chown --recursive 0:www-data /var/www
    #&& find /var/www -type f -exec chmod 664 {} \; \
    #&& find /var/www -type d -exec chmod 775 {} \; \
RUN chgrp --recursive www-data storage bootstrap/cache
RUN chmod --recursive ug+rwx storage bootstrap/cache
RUN apt-get update && \
    apt-get install dos2unix

RUN sed -i 's/\r$//' /schedule.sh

EXPOSE 9100
