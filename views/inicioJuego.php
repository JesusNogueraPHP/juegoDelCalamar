<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/examen.css" type="text/css" rel="stylesheet" /><!-- ruta relativa al index> -->
    <title>Comienza el Juego</title>
</head>

<body>
    <h1>INICIA EL JUEGO</h1>
    <p class="fin"><a href="index.php?c=juego&a=fin">Terminar Juego</a></p>
   
        <form class="formulario" action="index.php" method="get">
            <input type="hidden" name="c" value="juego">
            <input type="hidden" name="a" value="procesa">
            <div class="jugadoresGame">
                <?php
                foreach ($cajas as $caja) {
                    echo $caja;
                }
                ?>
            </div>
        </form>

    <?php  ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="./js/examen.js"></script>
</body>

</html>