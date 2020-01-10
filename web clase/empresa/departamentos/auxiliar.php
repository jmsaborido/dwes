<?php

const PAR = [
    'num_dep' => [
        'def' => '',
        'tipo' => TIPO_ENTERO,
        'etiqueta' => 'Número',
    ],
    'dnombre' => [
        'def' => '',
        'tipo' => TIPO_CADENA,
        'etiqueta' => 'Nombre',
    ],
    'localidad' => [
        'def' => '',
        'tipo' => TIPO_CADENA,
        'etiqueta' => 'Localidad',
    ],
    'cantidad' => [
        'def' => '',
        'virtual' => true,
        'tipo' => TIPO_ENTERO,
        'etiqueta' => 'Número de empleados',
    ],
];


function comprobarParametrosMod($par, $req, &$errores)
{
    $res = [];
    foreach ($par as $k => $v) {
        if (!isset($v['virtual'])) {
            $res[$k] = $v['def'];
        }
    }

    $peticion = peticion($req);
    if ((es_GET($req) && !empty($peticion)) || es_POST($req)) {
        if ((es_GET($req) || es_POST($req) && !empty($peticion))
            && empty(array_diff_key($res, $peticion))
            && empty(array_diff_key($peticion, $res))
        ) {
            $res = array_map('trim', $peticion);
        } else {
            $errores[] = 'Los parámetros recibidos no son los correctos.';
        }
    }
    return $res;
}

function comprobarValoresIndex($args, &$errores)
{
    if (!empty($errores)) {
        return;
    }

    extract($args);

    if (isset($args['num_dep']) && $num_dep !== '') {
        if (!ctype_digit($num_dep)) {
            $errores['num_dep'] = 'El número de departamento debe ser un número entero positivo.';
        } elseif (mb_strlen($num_dep) > 2) {
            $errores['num_dep'] = 'El número no puede tener más de dos dígitos.';
        }
    }

    if (isset($args['dnombre']) && $dnombre !== '') {
        if (mb_strlen($dnombre) > 255) {
            $errores['dnombre'] = 'El nombre del departamento no puede tener más de 255 caracteres.';
        }
    }

    if (isset($args['localidad']) && $localidad !== '') {
        if (mb_strlen($localidad) > 255) {
            $errores['localidad'] = 'La localidad no puede tener más de 255 caracteres.';
        }
    }
}

function comprobarValores(&$args, $id, $pdo, &$errores)
{
    if (!empty($errores) || empty($_POST)) {

        return;
    }

    extract($args);

    if (isset($args['num_dep'])) {
        if ($num_dep === '') {
            $errores['num_dep'] = 'El número de departamento es obligatorio.';
        } elseif (!ctype_digit($num_dep)) {
            $errores['num_dep'] = 'El número de departamento debe ser un número entero positivo.';
        } elseif (mb_strlen($num_dep) > 2) {
            $errores['num_dep'] = 'El número no puede tener más de dos dígitos.';
        } else {
            if ($id === null) {
                $sent = $pdo->prepare('SELECT COUNT(*)
                                         FROM departamentos
                                        WHERE num_dep = :num_dep');
                $sent->execute(['num_dep' => $num_dep]);
            } else {
                $sent = $pdo->prepare('SELECT COUNT(*)
                                         FROM departamentos
                                        WHERE num_dep = :num_dep
                                          AND id != :id');
                $sent->execute(['num_dep' => $num_dep, 'id' => $id]);
            }
            if ($sent->fetchColumn() > 0) {
                $errores['num_dep'] = 'Ese número de departamento ya existe.';
            }
        }
    }

    if (isset($args['dnombre'])) {
        if ($dnombre === '') {
            $errores['dnombre'] = 'El nombre del departamento es obligatorio.';
        } elseif (mb_strlen($dnombre) > 255) {
            $errores['dnombre'] = 'El nombre del departamento no puede tener más de 255 caracteres.';
        }
    }

    if (isset($args['localidad'])) {
        if ($localidad !== '') {
            if (mb_strlen($localidad) > 255) {
                $errores['localidad'] = 'La localidad no puede tener más de 255 caracteres.';
            }
        } else {
            $args['localidad'] = null;
        }
    }
}

function departamentoVacio($pdo, $id)
{
    $sent = $pdo->prepare('SELECT COUNT(*)
                             FROM empleados
                            WHERE departamento_id = :id');
    $sent->execute(['id' => $id]);
    return $sent->fetchColumn() === 0;
}
