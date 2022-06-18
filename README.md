**Juan Nicolás Murillo presenta:**
## Redarbor prueba front-end

Pasos para ejecutar esta prueba:

1. **Elige** una ubicación y usa el comando:

		git clone https://github.com/Jnicocom/look-employees.git
2. **Crea** una base de datos con el nombre:

		laravel
3. **Renombra** el archivo:

		.env.example  --> .env
	(Si es necesario, modifica el usuario y la contraseña de la base de datos)

5. **Dentro de la carpeta del proyecto**, usa estos comandos en orden:

		composer install
		php artisan key:generate
		php artisan migrate --seed
		php artisan serve
6. **Visita** *localhost* en un navegador moderno.

------------
Gracias por el tiempo y por el interés.
Nos vemos pronto ¿verdad?
