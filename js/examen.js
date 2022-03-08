//por defecto l oocultocuando verifique que el numero es par aparece
$('.submit').hide();

$('.generar').click(function (e) {
    e.preventDefault();
    var jugadores = $('.jugadores').val();
    jugadores = parseInt(jugadores, 10);
    if (isNaN(jugadores)) {
        $('.mensaje').html('').append("<span class=err>Debes ingresar un numero</span>");
        $('.jugadores').html('');
    } else if (jugadores % 2 != 0) {
        $('.submit').attr('disabled', " ");
        $('.mensaje').html('').append("<span class=err>El numero debe ser Par</span>");
        $('.jugadores').html('');
    } else {
        //si es valido es decir es un numero y es par creo los inputs para que ingresen sus nombres
        //si jugadores es < 0 lo seteo a 2  que es el minimo de jugadores que pueden jugar, si jugadores es > 10 lo seteo a 10 que es maximo de jugadores que acepta el examen, si es mayor que 0 y menor que 10 lo dejo como estaba
        jugadores = jugadores < 0  ? 2 : jugadores > 10 ? 10 : jugadores;
        $('.mensaje').html('').append("<span class=ok>Ingrese Nombre de Jugadores</span>");
        $.ajax({
            type: "GET",
            url: "index.php",
            data: {
                enviar: 'enviar',
                c: 'inicio',
                a: 'dameJugadores',
                numJugadores: jugadores
            },
            success: function (response) {
                //lo hago con xml porque asi lo pidio el ejercicio pero no tiene ningun sentido :D
                $('.submit').removeAttr('disabled', '');
                var listaJugadores = response.getElementsByTagName("jugador");
                var listadoJugadores = "";
                for (i = 0; i < listaJugadores.length; i++) {
                    if (i % 2 == 0) {
                        listadoJugadores += "<p>" + "<input type=text name=jugadores[] value=" + listaJugadores[i].firstChild.nodeValue + "> VS ";
                    } else if (i % 2 != 0) {
                        listadoJugadores += "<input type=text name=jugadores[] value=" + listaJugadores[i].firstChild.nodeValue + " > </p>"
                    }
                }
                $('.jugadores').html('').append(listadoJugadores);
                $('.submit').show();
            },
            async: true
        });
    }

});

$('.juega').click(function (e) {
    e.preventDefault();
    var totalBotones = $('.juega').length;
    $(this).attr('disabled', " ");
    var contador = 0;
    $.each($('.juega'), function (index, boton) { 
        if($(boton).attr('disabled')){
            contador++;
        }  
    });
    if(contador == totalBotones){
        $('.formulario').submit();
    }
})