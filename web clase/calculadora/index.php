<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Calculadora</title>
</head>

<body>
    <?php
    require __DIR__ . "/auxiliar.php";
    const OPS = ["+", "-", "*", "/"];
    $op1 = param("op1");
    $op2 = param("op2");
    $op = param("op");
    $errores = [];

    try {
        comprobarParametros($errores);
        comprobarErrores($errores);
        comprobarValores($op1, $op2, $op, OPS);
        comprobarErrores($errores);
        calcular($op1, $op2, $op);
    } catch (exception $e) {
        foreach ($errores as $err) {
            mensajeError($err);
        }
    }




    ?>
    <form action="" method="get">
        <label for="op1">Primer operando: </label>
        <input type="text" name="op1" id="op1" value="<?= $op1 ?>">
        <br>
        <label for="op2">Segundo operando: </label>
        <input type="text" name="op2" id="op2" value="<?= $op2 ?>">
        <br>
        <label for="op">Operacion: </label>
        <input type="text" name="op" id="op" value="<?= $op ?>">
        <br>
        <button type="submit">Calcular</button>
    </form>
</body>

</html>