Para los estandares de programacion PHP:
https://www.php-fig.org/psr/

Para descargar composer:
https://getcomposer.org/download/

Para utilizar composer:
* Agregar la descarga "composer.phar" a la carpeta raíz del proyecto.
* Crear el archivo composer.json
* instalar Composer https://getcomposer.org/Composer-Setup.exe Seleccionar el php.exe correspondiente
* Ejecutar en la carpeta raiz php composer.phar install

NOTA: Con Composer ya no necesitamos etar realizando "require" en todos los archivos, sencillamente se usa la configuración que este en Composer.json

Sitio web de alojamiento de paquetes PHP: packagist.org

Para utilizar Eloquent (Laravel) como ORM, asumiendo se tiene instaldo Composer en el equipo, ejecutar:
* php composer.phar require illuminate/database
* (Si composer esta instalado como global) composer install illuminate/database

Para traer de nuevo todos los paquetes externos, ejecutar:
* php composer.phar install
* (Si composer esta instalado como global) composer install

Para utilizar PSR7 (PHP Standard Recommendations 7: HTTP Interfaces), con esto los Requests se convierten en PSR7 compatible:
* composer require zendframework/zend-diactoros

Para utilizar un Router compatible con PSR7
* composer require aura/router

Para implementar un Template Engine que agrege validación a los elementos de entrada, utilizamos Twig:
* composer require twig/twig

Para implementar un validador de entradas:
* composer require respect/validation

Para leer variables de entorno:
* composer require vlucas/phpdotenv



