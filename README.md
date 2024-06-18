<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Passo a Passo

Copie o arquivo .env.example e renomeie para .env

``cp .env.example .env``

Execute o Docker e rode o seguinte comando para buildar

``docker-compose build``

Suba os containers

``docker-compose up -d``

Acesse o terminal do container

`` docker-compose exec -it app bash``

Execute as migrations

``php artisan migrate --seed``

Execute os commands para poder popular as tabelas de teams, players e games

``php artisan app:create-teams-command``

``php artisan app:create-players-command``

``php artisan app:create-games-command``
