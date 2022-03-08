<?php

//ejemplo del profe pero no funcionaba bien lo tuve que modificar
//si no existia el controlador ok hacia la funcion
//pero si si existia la variable c= pero el nombre no existia se rompia todo
//igual si la accion existia pero no estaba definida la accion o no existia se rompia todo
//ahora si esta perfect :)
function cargarControlador($controlador){

  $nombreControlador=ucwords(strtolower($controlador))."Controller";
  $archivoControlador='controllers/'.ucwords(strtolower($controlador))."Controller.php";

  if (!is_file($archivoControlador)){
    $archivoControlador='controllers/'.CONTROLADOR_PRINCIPAL."Controller.php";
    $nombreControlador = CONTROLADOR_PRINCIPAL."Controller";
  }

  require_once $archivoControlador;
  $controlador=new $nombreControlador();

  return $controlador;
}

function cargarAccion($controlador, $accion, $id=null){

    //si existe la accion y el metodo compruebo si tiene id y se lo paso a una accion con id y si no se lo paso a una accion que no tenga id
  if (isset($accion) && method_exists($controlador, $accion)){
      if ($id==null){
        $controlador->$accion();
      }
      else{
        $controlador->$accion($id);
      }

  }
  else{//si no existe la accion pero existe el controlador, compruebo si el controlador es DefectoController, si lo es,
    //cargo el index, si no lo es, cargo la accion de mostrar que es un metodo comun de los controladores que si existen y no son el por defecto
     if(get_class($controlador) == CONTROLADOR_PRINCIPAL."Controller"){
            $accion = ACCION_PRINCIPAL;
            $controlador->$accion();
     }else{
         $accion = "get";
         $controlador->$accion();
     }
    
  }


}
