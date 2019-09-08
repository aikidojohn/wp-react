#!/bin/sh

mysqld_safe --user=mysql &
sleep 5

mysql -u root < /var/lib/container/init.sql
