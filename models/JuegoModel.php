<?php
class JuegoModel
{
    public function creaCajas(&$jugadores)
    {
        //se pone unno u otro en funcion de si gane o pierda o aun no haya terminado el juego
        $ganador = "<span class=ok>GANADOR</span>";
        $perdedor = "<span class=err>PERDEDOR</span>";
        $boton = " <button class=juega>jugar</button>";
        foreach ($jugadores as $numJugador => $array) {
            //la posicion 0 es el nombre
            $cajas[$numJugador] = "<div class=caja>
            <fieldset>
            <p>Nombre: $array[nombre] </p>
            <p>Numero de Canicas: $array[canicas]</p>";
            $cajas[$numJugador] .= ($array['resultado'] == "en juego" ? "<p> Jugada: <label>Par</label><input type=radio name=jugadores[$numJugador][jugada] value=par checked> <label>Impar</label><input type=radio name=jugadores[$numJugador][jugada] value=impar></p>" : "");
            $cajas[$numJugador] .= ($array['resultado'] == "en juego" ? "<p> Numero de Canicas que juega <input type=number name=jugadores[$numJugador][apuesta] value=1 min=1 max=$array[canicas]> </p>" : "");
            $cajas[$numJugador] .= ($array['resultado'] == "en juego" ? $boton : ($array['resultado'] == "ganador" ? $ganador : $perdedor));
            $cajas[$numJugador] .= "</fieldset></div>";
        }
        return  $cajas;
    }
    public function procesa(&$jugadores)
    {
        foreach ($jugadores as $index => $jugador) {
            //asi cojo de 2 en 2 empezando por el 0 ya que el 0 % 2 es == 0
            if($index %2 == 0){
                if ($_SESSION['jugadores'][$index]['resultado'] == "en juego") {
                    //lo que hago aqui es que si el numero de apuesta es mayor al que tiene le seteo el maximo que tiene, y si es menor a 1 lo seteo a 1
                    //NO ME HACKIARAN!!
                    $jugadores[$index]['apuesta'] = ($jugadores[$index]['apuesta'] < 1 ? 1 : ($jugadores[$index]['apuesta'] > $_SESSION['jugadores'][$index]['canicas'] ?  $_SESSION['jugadores'][$index]['canicas'] : $jugadores[$index]['apuesta']));
                    //hago lo mismo con su pareja ya que lo recorro de 2 en 2
                    $jugadores[($index+1)]['apuesta'] = ($jugadores[($index+1)]['apuesta'] < 1 ? 1 : ($jugadores[($index+1)]['apuesta'] > $_SESSION['jugadores'][($index+1)]['canicas'] ?  $_SESSION['jugadores'][($index+1)]['canicas'] : $jugadores[($index+1)]['apuesta']));
                    if ($jugadores[$index]['jugada'] == $jugadores[$index + 1]['jugada']) {
                        //no hace nada solo por saber si son diferentes, aqui podria añadir mas funcionalidad al juego pero el jercicio no lo pide y ya me esta dando pereza
                        //aqui podria hacer si por ejemplo ambas jugadas son iguales mandar un mensaje o algo asi
                    } else { //si es diferente sumo y veo quien gana
                        //swicht true coje la sentencia verdadera de todas las condiciones  que estan en los case
                        switch (true) {
                            case ($jugadores[$index]['apuesta'] + $jugadores[($index + 1)]['apuesta']) % 2 == 0: //es par
                                //una ves que se si el resultado es par  veo quien jugo par para darle los puntos y al otro le resto
                                switch ($jugadores[$index]["jugada"]) {
                                        //si el jugador 1 tiene par se le suma a el si tiene impar y salio par pues el otro gano y sele suma a el
                                    case "par":
                                        $_SESSION['jugadores'][$index]['canicas'] +=  $jugadores[($index + 1)]['apuesta'];
                                        $_SESSION['jugadores'][($index + 1)]['canicas'] -= $jugadores[($index + 1)]['apuesta'];
                                        break;
                                    case "impar":
                                        $_SESSION['jugadores'][($index + 1)]['canicas'] +=  $jugadores[$index]['apuesta'];
                                        $_SESSION['jugadores'][$index]['canicas'] -= $jugadores[$index]['apuesta'];
                                        break;
                                }
                                break;
                                //aqui todo es igual que arriba pero alrevez
                            case ($jugadores[$index]['apuesta'] + $jugadores[($index + 1)]['apuesta']) % 2 != 0:
                                switch ($jugadores[$index]["jugada"]) {
                                        //si el jugador 1 tiene impar se le suma a el si tiene par y salio impar pues el otro gano y sele suma a el
                                    case "impar":
                                        $_SESSION['jugadores'][$index]['canicas'] +=  $jugadores[($index + 1)]['apuesta'];
                                        $_SESSION['jugadores'][($index + 1)]['canicas'] -= $jugadores[($index + 1)]['apuesta'];
                                        break;
                                    case "par":
                                        $_SESSION['jugadores'][($index + 1)]['canicas'] +=  $jugadores[$index]['apuesta'];
                                        $_SESSION['jugadores'][$index]['canicas'] -= $jugadores[$index]['apuesta'];
                                        break;
                                }
                                break;
                        }
                    }
                }
            }  
        }
    }
  
    public function comprobarGanadorPareja($jugadores)
    {
        for ($i = 0; $i < count($jugadores); $i += 2) {
            if ($jugadores[$i]['canicas'] <= 0) {
                $_SESSION['jugadores'][$i]['resultado'] = "perdedor";
                $_SESSION['jugadores'][($i + 1)]['resultado'] = "ganador";
            } elseif ($jugadores[$i]['canicas'] >= 20) {
                $_SESSION['jugadores'][$i]['resultado'] = "ganador";
                $_SESSION['jugadores'][($i + 1)]['resultado'] = "perdedor";
            }
        }
    }
}
