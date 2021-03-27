

# My GYM

Aplicación web basada en Laravel para la gestión de gimnasios y clubes.
 


## Requirements
- PHP >= 7.1.3
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- GD PHP Extension
- Imagick PHP Extension 

***Nota:***
// ///

##  Installation
1. correr `composer install` para instalar las dependencias
2. crear `.env` en la raizde la carpeta si composer no la crea. usar la estructura de 
```cp .env.example .env```
3. en `.env` actualizar datos de ingresos a la base de datos
4. corre  `php artisan key:generate` para generar un key
5. corre `php artisan migrate --seed` para migrar la base de datos
6. corre `php artisan serve` para iniciar el servidor local
7. abrir navegador en `http://localhost:8000/`
6. listo
```
email: admin@gymie.in
password: password
```

## si hat error el app_key

**depues de generar si en .env no se pega automaticamente copiala de la terminal y la pegas en**
- apregar APP_KEY to .env
- copia el  key generado de la terminal

**Permission / 500 Internal Server Error**

cambias los permisos de storage & cache
```
sudo chgrp -R www-data storage bootstrap/cache
sudo chmod -R ug+rwx storage bootstrap/cache
``` 

## usuario super admin

email: admin@mygym.io
password: password
```
