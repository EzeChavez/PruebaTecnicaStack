# Integración con API de StackOverflow

## Requisitos
- PHP >= 7.3
- Composer
- MySQL

## Configuración
1. Clona el repositorio:
git clone https://github.com/EzeChavez/PruebaTecnicaStack.git
cd stackoverflow-api

## Instalar dependencias
composer install

## Configurar el alchivo .env que esta en la raiz del repositorio con los datos conexion a la Base de datos Local
## o copiar y pegar los siguientes:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=stackoverflow
DB_USERNAME=root
DB_PASSWORD=

## Ejecutar las migraciones para crear las tablas 
php artisan migrate

## Ejecutuar el servidor
PHP serve

Como se solicito. Desarrollé una API con Laravel para consumut los recursos de la Api StackExchange.
Cree un endpoint que permite obrener datos sobre las Preguntas en Stack Overflow
La url para probar la misma es la siguiente 
## http://localhost/stackoverflow-api/public/api/preguntas?etiqueta=laravel&fecha_hasta=2024-05-24&fecha_desde=2024-01-01

Se pueden utilizar los siguientes parametros de busqueda:
Key: etiqueta | Value: laravel (Este es obligatorio)
Key: fecha_hasta | Value: 2024-05-24 (Opcional)
Key: fecha_desde | Value: 2024-01-01 (Opcional)

La integracion hacer una consulta a la API y registrar en la BD tanto la consulta realizada como la respuesta de la API.
Como adicional, cree una vista para poder hacer consultas a la api y ver un pequeño historial de las busquedas previas.
La vista se puede ver en el home del sitio.