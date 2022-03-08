<?php

require_once 'config/config.php';
require_once 'core/routes.php';
// require_once 'config/database.php';
// require_once 'models/Crud.php';
// require_once 'models/ModeloGenerico.php';

session_start();
//esto esta muy guapo asi me evito crear el objeto es algo asi como un metodo estatico pero sin serlo que se yo
//$coneccion = (new Conexion()) -> conectar();
if (!isset($_SESSION['juegoIniciado'])) {
    if (!isset($_GET['enviar'])) {
        $controlador = cargarControlador(CONTROLADOR_PRINCIPAL);
        cargarAccion($controlador, ACCION_PRINCIPAL);
    } else {
        cargarAccion(cargarControlador($_GET['c']), $_GET['a']);
    }
} else {
    if (isset($_GET['c'])) {
        $controlador = cargarControlador($_GET['c']);
        if (isset($_GET['a'])) {

            if (isset($_GET['id'])) {
                cargarAccion($controlador, $_GET['a'], $_GET['id']);
            } else {
                cargarAccion($controlador, $_GET['a']);
            }
        } else {
            cargarAccion($controlador, ACCION_PRINCIPAL);
        }
    } else {
        $controlador = cargarControlador("juego");//existe la sesion asi que cargo los datos de el juego
        $accion = "creaCajas";//la accion seria crear las cajas a partir de la sesion que ya esta iniciada
        $controlador->$accion();
    }
}

?>
