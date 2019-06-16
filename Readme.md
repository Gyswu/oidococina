Nette
---
Por defecto Nette utiliza PHP 7.1 o superior pero funciona mejor con PHP +7.2 para disponer de varias funciones, consultar composer.json para ver la version de PHP o cambiarla.

Configuracion del servicio web
---
- Hay que apuntar a la carpeta "ruta"/oidococina/www
- Habilitar los enlaces simbolicos
- Habilitar el mod rewrite

Base de datos
---
Importar timezone_posix.sql (La del repositorio o descargada oficialmente de mysql)
Importar base de datos oidococina.sql

Configuracion previa de nette
---
Por defecto el repositorio no incluye el archivo de configuracion de acceso a la base de datos.
Por lo tanto, hay que crear un archivo en la ruta "ruta"/oidococina/app/config/local.neon
Dentro de este archivo introducir los siguientes datos sin comillas

        dbal:
            driver: mysqli
            host: "ip de la base de datos"
            database: "tabla"
            username: "usuario de la base de datos"
            password: "contraseña"


Development by
---
Gyswu & Vichaunter


