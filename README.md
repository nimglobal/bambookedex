#Instrucciones
Desde la consola

-Clonar repositorio:
git clone https://github.com/nimglobal/bambookedex.git

-Instalar paquetes:
composer install

-Crear el archivo .env
cp .env.example .env
o
xcopy .env.example .env

-Generar key:
php artisan key:generate

-Cambiar rutas para base de datos y mail en el archivo .env

-Correr migraciones
php artisan migrate

-Correr seeders:
php artisan migrate --seed