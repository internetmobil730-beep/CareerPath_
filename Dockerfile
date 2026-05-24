FROM php:8.2-apache

# تثبيت الإضافات والمكتبات المطلوبة لتشغيل لارافيل
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl

# تثبيت إضافات PHP لقواعد البيانات وغيرها
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# تفعيل مود الـ Rewrite في سيرفر Apache ليقرأ مسارات لارافيل بشكل صحيح
RUN a2enmod rewrite

# ضبط الـ Document Root ليكون مجلد public الخاص بلارافيل
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# نسخ ملفات المشروع إلى السيرفر
WORKDIR /var/www/html
COPY . .

# تثبيت Composer وإعداد الحزم
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# إعطاء الصلاحيات المناسبة لمجلدات لارافيل
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

CMD ["apache2-foreground"]
EXPOSE 80