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

### Frameworks, Microframeworks y Librerias

Un framework es un software universal y reutilizable que proporciona una funcionalidad generica que el programador puede cambiar selectivamente escribiendo codigo especifico para una aplicacion en particular. Tambien proporciona un forma estandar de programar y desplegar aplicaciones. 
Pueden incluir herramientas para facilitar la programacion. 

Ruby on rails se considera el primer framework con exito

para crear un proyecto en yii usamos 

`composer create-project --prefer-dist ricpelo/yii2-app-basic:dev-master (nombre)`

pero lo abreviariamos con `proyecto.sh (nombre)`

para arrancar el prorgama usamos `./yii server`

### Patron Modelo Vista Controlador

Las peticiones web las recibe el controlador desde el cliente. 

los modelos son el representante dentro de la aplicacion de una coleccion de datos

la vista obtiene los datos del modelo y muestra el resultado.

lo canonico es que el controlador este entre la vista y el modelo, y sea este el que hace que interactuen ambas

#### En Yii

Los modelos son subclases de `yii\base\model` o tambien de `\yii\db\activerecord` (este ultimo es un caso especial ya que son los modelos que representan las tablas de bases de datos)

las vistas son plantillas .php que combinan html y php

los controladores son subclases de `yii\base\controller` cambiando web o console en lugar de base para los entornos de consola o web 

para mostrar el resultado en vez de `./yii serve` usamos `make serve`

`web/index.php` -> script de entrada de la pagina web

Para depurar usamos 
```php
Yii:debug(Lo que sea);
```

para evitar el xss usamos 

```php
Html\encode(cadena)
```

Hay 3 formas de acceder a bases de datos desde yii

la capa mas basica es el DAO (Data Access Objects)

y por encima del DAO está el Query Builder

El Query Builder construye ordenes SQL a partir de lenguaje orientado a objetos

Por encima de todo esta el Active Record.

En DAO seria:
```php
 Yii::$app->db->createCommand("select * from table")->queryOne()
```
Los querys son 
* All (todas las filas)
* One (1 fila)
* Columns (1 Columna
* Scalar (1 Valor)
  
En QueryBuilder seria 
```php
$fila = (new yii\db\Query())
    ->from('table')
    ->where() //el where es un array, cada indice es un valor  que se tiene que cumplir todos (un AND)
    ->one()
```
Con el active record primero entrariamos en el gii y creariamos un modelo.

```php
$libro= \app\models\Libros::findOne(1);
```
Para hacer consultas que te devuelvan objetos del active record usamos Active Query
par

para crear formularios usamos unos helpers apoyados en html

```php
<?= Html::beginForm()?>
<div class="group-form">
    <?= Html::label('Nombre','Nombre')?>
    <?= Html::textInput('nombre',null,['id'=>'nombre','class'=>'form-control'])?>
</div>
<?= Html::submitButton('Enviar',)>
<?= Html::endForm()?>
```

pero la forma que usaremos es ActiveForm 


para coger datos de una peticion post usamos 

```php
if($datos=Yii::$app->request->post())
```

en gii--> crud Generator
* Model Class-->app/models/Libros
* Search Model Class--> app/models/LibrosSearch
* Controllers Class--> app/controllers/LibrosController

## ***Tema 12: Estructura de una aplicacion en Yii a pequeña***

### *Componentes*

los componentes son los principales bloques de construccion de una aplicacion Yii

Los componentes son instancias de `yii\base\Component`

Se caracterizan por tener: 
* Propiedades se hereda de `yii\base\BaseObject`
* Configurabilidad se hereda de `yii\base\BaseObject`
* Eventos 
* Comportamientos

### Propiedades

si la clase hereda de `yii\base\BaseObject` la clase tendria ya un getter y un setter

`getLabel()`+`setLabel()`=`$foo->label`

### Configurabilidad

Una configuracion es simplemente un array que contiene parejas de clave=>valor donde la clave representa el nombre de una propiedad y el valor es el valor que queremos asignarle a dicha propiedad

Se usan para: 

* Asignar valores de forma masiva a las propiedades de un objeto usando `Yii::configure($objeto, $config)`
* Crear una instancia asignandoles valores iniciales a sus propiedades usando. 
  Es decir,crea configura y usa el contenedor de inyeccion de depencencia `Yii::createObject([rutaCompleta::[className() ó class])`
* Crear una nueva instancia con new y pasandole la configuracion al constructor. 
  Este crea,configura pero no usa el contenedor de inyeccion de dependencia asi que usaremos el segundo

### Eventos

Los eventos permiten inyectar codigo dentro de codigo ya existente en determinados puntos de ejecucion

Se puede vincular un trozo de cofigo a un evente de forma que cuando el evento se dispare se ejecutara el codigo automaticamente
si un manejador ejecuta `$event->handled=true` ya no se dispararian mas eventos en esa instancia


* Eventos manejadores de instancia `$p=>on(EVENTO,callable)`
* Eventos manejadores de clase `Event::on(Clase,EVENTO,callable)`
* Eventos de instancia `$p->trigger(EVENTO)`
* Eventos de clase `Event::trigger(Clase,EVENTO)`

### Comportamientos

Los comportamientos permiten ampliar la funcionalidad de una clase sin afectar a su herencia

al acoplar un comportamiento a un componente se inyectan los metodos y las propiedades del comportamiento dentro del componente

el componente podra usar esos metodos y propiedades como si estuvieran definidos en la clase del componente

ademas un comportamiento puede responder a los eventos disparados por el componente lo que le permite alterar la ejecucion normal del codigo del componente

todos los comportamientos son subclases de yii\base\Behavior

acomplamiento estatico

se sobreescribe el metodo behaviors del componente al que se desea acoplar. Este metodo tiene que devolver una configuracion
Se puede hacer de 4 formas

anonimo poniendo solo el nombre de la clase `Comportamiento::className()`

con nombre, solo el nombre de la clase

`comp2=> Comportamiento::className()`

anonimo, array de configuracion 

`[la configuracion macho, que no me da tiempo]`

con nombre, array de configuracion

`pues junta el 2 y el 3, basicamente`

### Alias

Representan rutas o URL

Se usan para no tener que codificar rutas absolutas o url directamentes en el proyecto

empiezan por @ y yii tiene varios alias predefinidos como porejemplos 

`Yii::getAlias('@app')`-->`/home/saborido/proyecto`
`Yii::getAlias('@yii')`-->`home/saborido/proyecto/vendor/yiisoft/yii2`

para crearlos
`Yii::setAlias(nombre,ruta_o_URL)`

### Localizadores

Es un objeto que sabe com proporcionar todo tipo de servicios que pueda necesitar una aplicacion

Dentro del localizador de servicios cada componente existe como una unica instancia identificada mediante un id que se usa para recuperar el componente de dentro del localizador de servicios

el localizador de servicios es una instancia de yii/di/ServiceLocator

El mas tipico en yii es el objeto aplicacion al que se acceemediante /Yii::$app los servicios que proporciona se denominan componentes de aplicacion, como request, response,db o urlManager. Esos componentes se suelen definir mediante configuraciones

### Contenedor de Inyeccion de Dependencias

Es un objeto que sabe como instanciar y configurar objetos y todos los objetos de los que depende

Resuelve automaticamente las posibles dependencias y las inyecta en el nuevo objeto

Al llamar al metodo `Yii:::createObject()` este llama a `Yii::$container->get()` para crear el nuevo objeto. Esto permite personalizar globalmente la inicializacion de objetos

Con `yii::$container->set()` sirve para registrar una dependencia

## ***Tema 12.5: Estructura de una aplicacion en Yii a gran escala***


## ***Tema 13: Gestion de peticiones***
