#!/bin/sh

mysqld_safe --user=mysql &
sleep 5

wp core download --path=/var/www/localhost/htdocs/ --version=5.2.2
wp config create --path=/var/www/localhost/htdocs/ --dbname=deshette --dbuser=deshette --dbpass=deshette --dbcharset=utf8mb4
wp core install --path=/var/www/localhost/htdocs/ --url=http://localhost:8080/ --title=Deshette --admin_user=admin --admin_password=admin --admin_email=aikidojohn@gmail.com --skip-email
wp rewrite structure '/%postname%/' --path=/var/www/localhost/htdocs/
wp plugin install fakerpress --path=/var/www/localhost/htdocs/ --activate
wp plugin install add-from-server --path=/var/www/localhost/htdocs/ --activate
wp plugin install wp-rest-api-v2-menus --path=/var/www/localhost/htdocs/ --activate
chown -R apache:apache /var/www/localhost/htdocs/
