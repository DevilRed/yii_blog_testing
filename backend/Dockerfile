FROM yiisoftware/yii2-php:5.6-apache

# Change document root for Apache
# RUN sed -i -E 's|/var/www/html|/app/backend/web|g' /etc/apache2/sites-available/000-default.conf
COPY . /var/www/html
RUN sed -i -E 's|/var/www/html|/var/www/html/backend/web|g' /etc/apache2/sites-available/000-default.conf