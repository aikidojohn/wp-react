GRANT ALL ON *.* TO deshette@'127.0.0.1' IDENTIFIED BY 'deshette' WITH GRANT OPTION;
GRANT ALL ON *.* TO deshette@'localhost' IDENTIFIED BY 'deshette' WITH GRANT OPTION;
GRANT ALL ON *.* TO deshette@'::1' IDENTIFIED BY 'deshette' WITH GRANT OPTION;
CREATE DATABASE deshette;
DELETE FROM mysql.user WHERE User='';
DROP DATABASE test;
FLUSH PRIVILEGES;
