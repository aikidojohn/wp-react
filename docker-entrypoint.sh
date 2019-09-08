#!/bin/sh

mysqld_safe --user=mysql &
httpd -DFOREGROUND

