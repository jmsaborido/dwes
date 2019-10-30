<?php

/**
 * devuelve el valor de un parametro get o cadena vacia si no existe
 *
 * @param  string $p la cadena que recibe
 * @return string cadena vacia o la cadena sin espacios delante y atras
 */

function param($p): string
{
    return isset(($_GET[$p])) ? trim($_GET[$p]) : "";
}

/**
 * calcula la suma, resta, multiplicacion y division de dos numeros dados
 *
 * @param int    $op1 el primer operando
 * @param int    $op2 el segundo operando
 * @param string $op  la operacion deseada
 * @return void
 */
function calcular(&$op1, $op2, $op)
{
    switch ($op) {
        case '+':
            $op1 += $op2;
            break;
        case '-':
            $op1 -= $op2;
            break;
        case '*':
            $op1 *= $op2;
            break;
        case '/':
            $op1 /= $op2;
            break;
    }
}

function comprobarParametros(&$errores)
{
    $par = ["op1", "op2", "op"];
    if (!empty($_GET)) {
        if (!(empty(array_diff($par, array_keys($_GET)) &&
            empty(array_diff(array_keys($_GET), $par))))) {
            $errores[] = "Los parametros recibidos no son los correctos";
        }
    }
}

function comprobarValores($op1, $op2, $op, $ops)
{


    return (is_numeric($op1) && is_numeric($op2) && in_array($op, $ops));
}

/**
 * Vuelca por la salida un mensaje de error
 *
 * @param string $cadena
 * @return void
 */

function mensajeError(String $cadena)
{
    ?><div class="error"><?= $cadena ?></div>
    <?php
    }
function comprobarErrores($errores){
    if(!empty($errores)){
    throw new Exception()}
}
