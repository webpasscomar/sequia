FROM php:8.2-apache

# Instalar dependencias
RUN apt-get update \
    && apt-get install -y gnupg curl wget ca-certificates unzip lsb-release \
    && wget --quiet -O - https://www.postgresql.org/media/keys/ACCC4CF8.asc | apt-key add - \
    && echo "deb http://apt.postgresql.org/pub/repos/apt/ `lsb_release -cs`-pgdg main" | tee  /etc/apt/sources.list.d/pgdg.list \
    && curl -sL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y \
        libicu-dev \
        libpq-dev \
        libzip-dev \
        nodejs \
        postgresql-client-15 \
    && docker-php-ext-configure zip \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install intl pdo pdo_pgsql pgsql zip bcmath pcntl exif \
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
        && npm install -g npm \
        && apt-get -y autoremove \
        && apt-get clean \
        && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Configurar Apache
COPY ./docker/apache/default.conf /etc/apache2/sites-enabled/000-default.conf

RUN a2enmod rewrite
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Configurar PHP
COPY ./docker/php/php.ini /usr/local/etc/php/

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Directorio de trabajo
WORKDIR /var/www/html 
# Copiar código fuente
COPY . /var/www/html

# Instalar dependencias de Composer
RUN cd /var/www/html && composer install --ignore-platform-reqs --optimize-autoloader

# Generar key de Laravel
RUN php artisan key:generate

RUN php artisan storage:link

RUN composer dump-autoload

# Permiso a carpetas de almacenamiento
RUN chown -R www-data:www-data \
  /var/www/html/storage \
  /var/www/html/bootstrap/cache

RUN npm install \
    && npm run dev

# Puerto expuesto
EXPOSE 80 443 5173