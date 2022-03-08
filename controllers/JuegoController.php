<?php
require_once "./models/JuegoModel.php";
require_once "./models/InicioModel.php";

class JuegoController
{
    public function creaCajas()
    {
        //esto es para la primera vez que entra setear lso valores en la sesion, y ya despues par todo usao la sesion
        if (isset($_GET['jugadores'])) {
            //vuelvo a comprobar que el numero sea par por si lo modifican en el cliente, NO ME HACKEARAN!!
            $esPar = (new InicioModel())->esPar(count($_GET['jugadores']));
            if (!$esPar) {
                $msg = "<span class=err> Debes ingresar Un numero Par</span>";
                require_once "./views/formInicioJuego.php";
                die();
            }
            //si es par y todo ok inicio el juego
            $_SESSION['juegoIniciado'] = true;
            $contador = 0;
            foreach ($_GET['jugadores'] as $index => $nombreJugador) {
                $_SESSION['jugadores'][$contador]['nombre'] = $nombreJugador;
                //por defecto la primera vez tienen 10 al inicio 
                $_SESSION['jugadores'][$contador]['canicas'] = 10;
                //cambiara a ganador o pèrdedor segun sea el caso
                $_SESSION['jugadores'][$contador]['resultado'] = "en juego";
                $contador++;
            }
        }
        $cajas = (new JuegoModel)->creaCajas($_SESSION['jugadores']);
        require_once './views/inicioJuego.php';
    }

    public function procesa()
    {
        (new JuegoModel)->procesa($_GET['jugadores']);
        (new JuegoModel)->comprobarGanadorPareja($_SESSION['jugadores']);
        $cajas = (new JuegoModel)->creaCajas($_SESSION['jugadores']);
        require_once './views/inicioJuego.php';
    }
    public function fin()
    {
        session_destroy();
        $msg = "<span class=done>Juego Terminado</span>";
        require_once "./views/formInicioJuego.php";
    }
}
