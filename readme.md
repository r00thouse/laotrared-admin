LaOtraRed - Administrador
===========================

Panel de administración de nodos para el proyecto LaOtraRed.

## Entorno de desarrollo y pruebas locales
Se necesitan los siguientes paquetes: php5-fpm php5-cli php5-mysql

Instalar composer: https://getcomposer.org/download/

Entrar al directorio del proyecto y ejecutar

    $ composer install

## Configuración
La configuración debe ser especificada en el archivo .env donde cada quien puede poner configuraciones personalizadas. Este archivo no es versionado pero existe un archivo de ejemplo .env.example y es necesario copiarlo para tener un archivo de configuración propio

    $ cp .env.example .env

Luego es necesario generar la key de la aplicación, para ello ejecutar

    $ php artisan key:generate

### Configuración de la base de datos
Crear una base de datos en mariadb, por ejemplo laotrared y especificar en el archivo .env en la sección:

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laotrared
    DB_USERNAME=usuario
    DB_PASSWORD=password

Para crear las tablas y datos de prueba ejecutar

    $ php artisan migrate --seed

Y para correr el servidor de prueba

    $ php artisan serve


#### Nota
Si se desea utilizar otro motor de base de datos como sqlite3, la configuración en el archivo .env sería:

    DB_CONNECTION=sqlite
    DB_DATABASE=laotrared.sqlite

Es importante tener instalado el paquete php5-sqlite si se desea utilizar este motor de base de datos
