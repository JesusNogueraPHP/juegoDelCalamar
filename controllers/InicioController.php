<?php
require "./models/InicioModel.php";
class InicioController extends InicioModel
{
    public function index()
    {
        require_once "./views/formInicioJuego.php";
    }

    public function dameJugadores(){
        header("Content-type: text/xml");
        $xml = "<?xml version='1.0' encoding='UTF-8'?>";
        $xml .= "<jugadores>";
        for($i = 0; $i < $_GET['numJugadores']; $i ++){
            $xml .="<jugador>Jugador".($i+1)."</jugador>";
        }
        $xml .="</jugadores>";
        echo $xml; 
    }

    public function inicioJuego()
    {
        require "./views/inicioJuego.php";
    }
}
    // public function comprobar()
    // {
    //     if (is_numeric($_GET['jugadores'])) {
    //         $esPar = (new InicioModel)->esPar($_GET['jugadores']);
    //         if($esPar){
    //             $_SESSION['juegoIniciado'] = true;
    //             $_SESSION['numJugadores'] = $_GET['jugadores'];
    //             for($i = 0; $i < $_SESSION['numJugadores']; $i++){
    //                 $_SESSION['jugadores'][$i]['canicas'] = 10; 
    //             }
    //             require_once "./views/inicioJuego.php";
    //         }else{
    //             $msg = "<span class=err> Debes ingresar Un numero Par</span>";
    //             require_once "./views/formInicioJuego.php";
    //         }
    //     }else{
    //         $msg = "<span class=err>Debes Ingresar Un Numero</span>";
    //         require_once "./views/formInicioJuego.php";
    //     }
    // }
