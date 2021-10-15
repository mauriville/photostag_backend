
## Mapa de Monitoreo Backend

Sistema para monitoreo de Venta de COmbustible

## Requisitos

1. Apache, PHP 7.3 o superior, Postgres 11.0

Los pasos para realizar el despliegue son:

- copiar el archivo .env.suggested  a.env
- configurar conexión a la base de datos en el archivo .env
- composer install
- php artisan migrate --seed
- php artisan passport:install
- php artisan key:generate
- Si estas trabajando en ambiente linux otorgar permisos de escritura a las carpetas **storate/logs** y **storage/framework**
- php artisan serve
- abrir en el navegador http://localhost:8000 
- abrir en un rest client (Postman Insomnia) **usuario:** hvillegasv@change.me  **contraseña:** secret

## Créditos

Este usa los siguientes repositorios:

- **[Laravel](https://laravel.com/)**
- **[Laravel Datatables](https://datatables.yajrabox.com/)**


## Licencia

Este proyecto es de código abierto y licenciado bajor [MIT license](https://opensource.org/licenses/MIT).