FROM alpine:3.10

RUN apk add apache2 mariadb mariadb-client php7-apache2 php7-pdo php7-pdo_mysql php7-session php7-json php7-cli php7-phar php7-iconv php7-mysqli

# Set up MariaDB
RUN mysql_install_db --user=mysql --datadir=/var/lib/mysql
COPY init.sql /var/lib/container/init.sql
COPY sql_setup.sh /var/lib/container/sql_setup.sh
RUN /var/lib/container/sql_setup.sh

RUN rm -rf /var/www/localhost/htdocs/*
RUN  sed -i 's/Listen 80/Listen 80\nListen 8080/' /etc/apache2/httpd.conf
# Enable mod rewrite
RUN  sed -i 's/#LoadModule rewrite_module modules\/mod_rewrite.so/LoadModule rewrite_module modules\/mod_rewrite.so/' /etc/apache2/httpd.conf 
RUN  sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/httpd.conf 

RUN wget -O /usr/local/bin/wp https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
RUN chmod +x /usr/local/bin/wp

COPY wp_setup.sh /var/lib/container/wp_setup.sh
RUN /var/lib/container/wp_setup.sh

EXPOSE 80/tcp
EXPOSE 8080/tcp
EXPOSE 3306/tcp

COPY docker-entrypoint.sh /var/lib/container/docker-entrypoint.sh
ENTRYPOINT /var/lib/container/docker-entrypoint.sh
