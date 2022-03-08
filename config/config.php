<?php
//si no existe ningun controlador llamo al controlador DEFECTO que carga el index
//si existe algun controlador pero no existe la accion cargo la accion mostrar de ese controlador para que liste los elementos de esa tabla
//si existe el controlador y existe la accion pues cargo la accion corespondiente
//que bonito es mvc :D
define("CONTROLADOR_PRINCIPAL", "Inicio");
define("ACCION_PRINCIPAL", "index");



?>