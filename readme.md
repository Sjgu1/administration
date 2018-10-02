<p align="center"><img src="/cliente/assets/img/logo_redondeado.png" width="400"></img></p>

# Crisantemo &nbsp;
Crisantemo es un programa realizado con el framework Laravel. Se trata de un sistema de gestión de proyectos del ámbito informático. Permiten la creación de proyectos, sprints e incidencias, con herramientas visuales para conocer el estado de desarrollo, el historial de eventos, gráficos ilustrativos y responsables de tareas.

## Guía de instalación

Siga estas instrucciones para obtener una copia de este proyecto funcionando correctamente en tu sistema operativo.

### Prerrequisitos <img align="right" width="200" src="/cliente/assets/img/golang_gintonico.png"></img> 
Para poder utilizar este proyecto es necesario tener instaladas ciertas herramientas, como son composer y php.

Con estas herramientas son necesarios ejecutar ciertos comandos con el fin de llenar de ejemplos el programa y lanzar un servidor para su ejecución.

> *Ejecutar estos comandos en la carpeta del proyecto.
```
$ composer update
$ touch database/database.sqlite
$ cp .env.example .env
$ php artisan migrate --seed
$ php artisan key:generate
```

### Instalando y ejecutando Gintónico

Para compilar el proyecto Gintónico necesitamos ejecutar el comando:
> *Ejecutar este comando para lanzar la aplicación*.
```
$ php artisan serve
```

Una vez lanzado se puede acceder a través del navegador con la siguiente dirección

> Windows:   ``` http://127.0.0.1:8000>```

A continuación se muestran algunos ejemplos del programa.

Inicio:
<p align="center"><img src="1.gif" width="450"></img></p>
Panel principal y proyectos:
<p align="center"><img src="2.gif" width="450"></img></p>
Gestión de usuarios y roles:
<p align="center"><img src="3.gif" width="450"></img></p>
Tablón de incidencias:
<p align="center"><img src="4.gif" width="450"></img></p>

## Licencia

Este proyecto está bajo la licencia GNU GPL v3 - revisa [LICENSE](LICENSE) para ver más detalles.
