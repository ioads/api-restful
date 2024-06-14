FROM php:8.1-apache

# Instalação das extensões necessárias do PHP
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Define o diretório de trabalho como o diretório da aplicação Laravel
WORKDIR /var/www/html
