FROM php:8.1-apache

# Copia os scripts para o diretório do Apache
COPY index.php /var/www/html/
# Copia a base de dados para /var/www/
COPY codigos_postais.sqlite3 /var/www/

RUN chmod 644 /var/www/codigos_postais.sqlite3

EXPOSE 80