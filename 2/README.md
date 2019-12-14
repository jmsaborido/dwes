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


El control de versiones no tendra en cuenta la carpeta vendor  ya que esto hara que sea mas pesada nuestra aplicacion.

El `composer.json` nos dice que version del paquete usamos, el `composer.lock` contiene las versiones exactas con las que estamos trajabando 

Las versiones de los paquetes que usamos en desarrollo tienen que ser las mismas que las que usamos en produccion 

`c install` 

Busca en composer.lock y se descarga las versiones de las dependencias.

`c update`

Actualiza los paquetes, no la usaremos mucho

En composer `8` = `8.0` = `8.0.0`

##### Tipos de restricciones:

Para escoger las versiones lo mejor es usar esta [pagina](https://semver.mwl.be)

1. Poniendo numero de versión  `8.0.4`
2. Rangos de versiones `>=1.0 <1.1 || >=1.2`
3. Rango con guion ` 1.0 - 2.0 `  
4. Asterisco `1.0.*`
5. Virgulilla `~1.0`
   * especifica la version minima y deja que avance el numero menor. 
6. Circunflejo 
