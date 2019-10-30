<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>El programa que saluda</title>
    <style>
        .error {
            color: red;
            font-weight: bold;

        }
    </style>
</head>

<body>

    <?php
    require __DIR__ . "/auxiliar.php";
    $numero = param("numero");
    ?>

    <form action="index.php" method="get">
        <label for="numero">Numero:</label>
        <input type="text" id="numero" name="numero" value="<?= $numero ?>">
        <br>
        <button type="submit">Mostrar</button>

    </form>

    <?php
    if (isset(($_GET['numero']))) {
        if ($numero != "") {
            if (ctype_digit($numero)) {
                if ($numero >= 0 && $numero <= 10) {
                    dibujar_tabla($numero);
                } else {
                    mensaje_error("El numero debe estar entre 0 ó 10");
                }
            } else {
                mensaje_error("Solo puede haber digitos");
            }
        } else {
            mensaje_error("El numero es obligatorio");
        }
    }

    ?>



</body>

</html>