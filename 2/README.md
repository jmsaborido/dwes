# Trimestre 2

## ***Tema 10: Interoperabilidad***

### *Versionado Semantico*

Hay un convenio con el numero de versiones. Podemos entrar en este [link](http://www.semver.org) para verlo.

Se deberia escribir con la forma X.Y.Z donde XYZ son numeros enteros no negativos.

* X Numero Mayor
* Y Numero Menor
* Z Parche

Una vez sacada una version, no se debe modificar esa version.

### *Composer*

[Composer](https://getcomposer.org) es un gestor de dependencias, no de paquetes.

El repositorio de paquetes de composer esta [aquí](https://www.packagist.org).

Deberiamos trabajar con versiones estables.


#### Uso basico de Composer

Tiramos con el script de ricardo localizado en `~/.conf/scripts/composer-install.php`.

despues de eso creamos una prueba y usamos en la terminal.

`c require X/Y` 

`require` lo que hace es añadir dependencias a tu proyecto

Siendo X = nombre de usuario del paquete e Y = nombre del paquete.

si quieres añadir una dependencia solo para el desarrollo usariamos 

`c require --dev X/Y` 

El control de versiones no tendra en cuenta la carpeta vendor  ya que esto hara que sea mas pesada nuestra aplicacion.

El `composer.json` nos dice que version del paquete usamos, el `composer.lock` contiene las versiones exactas con las que estamos trajabando 

Las versiones de los paquetes que usamos en desarrollo tienen que ser las mismas que las que usamos en produccion 

`c install` 

Busca en composer.lock y se descarga las versiones de las dependencias. Tanto las require como require dev. Para no instalar las del dev usariamos `c install --no-dev`. Esto lo haria ya la nube por si sola. 

`c update`

Actualiza los paquetes, no la usaremos mucho

En composer `8` = `8.0` = `8.0.0`

##### [Tipos de restricciones:](https://getcomposer.org/doc/articles/versions.md)

Para escoger las versiones lo mejor es usar esta [pagina](https://semver.mwl.be)

1. Poniendo numero de versión  `8.0.4`
2. Rangos de versiones `>=1.0 <1.1 || >=1.2`
3. Rango con guion ` 1.0 - 2.0 `  
4. Asterisco `1.0.*`
5. Virgulilla `~1.0`
   * Especifica la version minima y deja que avance el numero menor. 
6. Circunflejo  `^1.0`
   * Especifica la version minima dentro de un numero mayor. 
7. Nombres De Ramas `dev-master`
8. Restricciones de estabilidad `1.2.0-stable`

### Uso de paquetes dentro de php

Para llamar a un paquete dentro de codigo php usamos

```php
require __DIR__ . '/vendor/autoload.php';
```

### [PHP-FIG](http://www.php-fig.org/psr/)

Las directivas que nos deberemos mirar son: 

#### [1 Basic Coding Style](http://www.php-fig.org/psr/psr-1/) 
#### [4 Autoloader](http://www.php-fig.org/psr/psr-4/) 
#### [12 Extended Coding Style](http://www.php-fig.org/psr/psr-12/) 
#### [5 PHPDoc Standard](https://github.com/php-fig/fig-standards/blob/master/proposed/phpdoc.md) (En borrador, puede cambiar en un futuro.)

## ***Tema 11 Introduccion a Yii 2***

Un framework es un software universal y reutilizable que proporciona una funcionalidad generica que el programador puede cambiar selectivamente escribiendo codigo especifico para una aplicacion en particular. Tambien proporciona un forma estandar de programar y desplegar aplicaciones. 
Pueden incluir herramientas para facilitar la programacion. 

Ruby on rails se considera el primer framework con exito

para crear un proyecto en yii usamos 

`composer create-project --prefer-dist ricpelo/yii2-app-basic:dev-master (nombre)`

para arrancar el prorgama usamos `./yii serve`