<?php

/**
 * Vuelca por la salida una fila de la tabla de multiplicar
 *
 * @param string|int $n
 * @param int $i
 * @return void
 */

function fila($numero, int $i)
{
    $res = $numero * $i;
    echo "$numero x $i = $res"; ?>
    <br><?php
}

/**
 * Vuelca por la salida un mensaje de error
 *
 * @param string $cadena
* @return void
*/

function mensaje_error(String $cadena)
{
    ?><div class="error"><?= $cadena ?></div>
    <?php
}

/**
 * devuelve el valor de un parametro get o cadena vacia si no existe
 *
 * @param string $p la cadena que recibe
 * @return string cadena vacia o la cadena sin espacios delante y atras
 */

function param($p): string
{
    return isset(($_GET[$p])) ? trim($_GET[$p]) : "";
}

/**
 * recorre las filas que se van a dibujar
 *
 * @param int $numero el numero que se va a multiplicar
 * @return void
 */

function dibujar_tabla($numero): void
{
    for ($i = 0; $i <= 10; $i++) {
        fila($numero, $i);
    }
}
