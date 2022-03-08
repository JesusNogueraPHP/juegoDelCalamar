<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/examen.css" type="text/css" rel="stylesheet" /><!-- ruta relativa al index> -->
    <title>Inicio de Juego</title>
</head>

<body>
    <h1>Juego Del Calamar</h1>
    <p class="mensaje"><?php echo $msg ?? '' ?></p>
    <form action="index.php" method="GET">
        <fieldset>
            <legend>ELIJA NUMERO DE JUGADORES</legend>
            <br>
            <input type="text" name="jugadores" class="jugadores"><br><br>
            <input type="submit" class="generar" value="GenerarJugadores">

        </fieldset>
    </form>
    <form action="index.php">
        <input type="hidden" name="c" value="juego">
        <input type="hidden" name="a" value="creaCajas">
        <div class="jugadores">

        </div>
        <input class="submit" type="submit" name="enviar" value="JUGAR">
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="./js/examen.js"></script>
</body>

</html>