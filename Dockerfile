FROM php:8.2-apache

# تثبيت الإضافات الأساسية وتعاريف PostgreSQL المفقودة
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    zip \
    unzip

# تثبيت الدريفرات لـ MySQL و PostgreSQL معاً لضمان عدم حدوث أخطاء
RUN docker-php-ext-install pdo_mysql pdo_pgsql mbstring gd
RUN a2enmod rewrite

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# نسخ المشروع بالكامل
WORKDIR /var/www/html
COPY . .

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80
ENV PORT=80

RUN php artisan migrate:fresh --seed --force