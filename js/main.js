(function(){
    "use strict";

    // Funcion que ejecuta el codigo cuando la pagina termina de cargar, es como el "ready" de jquery
    document.addEventListener('DOMContentLoaded', function(){
// ======================================================================================================================================
        /*** MAPA ***/
        
        // Valores para posisionar el mapa:
        //                              [-27.479444, -55.750095]
        // Valores para configurar el Zoom:
        //                                                        14

        //// Comprobamos que el ID 'mapa' exista con una condicional
        if(document.getElementById('mapa')){ 
        var map = L.map('mapa').setView([-27.479444, -55.750095], 14);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        // Valores para posisionar el mapa:
               //[-27.479444, -55.750095]
        L.marker([-27.479444, -55.750095]).addTo(map)
        // Funciones para personalizar el mapa
            .bindPopup('GDLWEBCAMP<br> Boletos Disponibles.') // Agregamos el texto en el Popup
            .openPopup() // Mostramos el Popup
            .bindTooltip('Esto es un Tooltip') // Agregamos el texto en el Tooltip
            .openTooltip(); // Mostramos el Tooltip   
        }
          
    }) // DOM CONTENT LOADED;
})();

/** CODIGO CON JQUERY **/
$(function(){

    /** TITULO DEL SITIO WEB **/
    // Agrega la Etiqueta "span" con las clases "char" a cada Caracter que contenga el nodo seleccionado
    // Da mas flexibilidad a la hora de dar estilo

    // PLUGIN - lettering
    // Comprobamos que la clase 'nombre-sitio' exista con una condicional 
    if(document.getElementsByClassName('nombre-sitio')){
        $('.nombre-sitio').lettering();
    }

    // Agregamos la clase "activo" a los indices de Conferencia, Calendario e Invitados, y al indice de Reservaciones le agregamos la clase "Registro". De esta forma le marcamos al usuario en que lugar del sitio se encuentra.
    $('body.conferencia .navegacion-principal a:contains("Conferencia")').addClass('activo');
    $('body.calendario .navegacion-principal a:contains("Calendario")').addClass('activo');
    $('body.invitados .navegacion-principal a:contains("Invitados")').addClass('activo');
    $('body.registro .navegacion-principal a:contains("Reservaciones")').addClass('registro');


    /** PROGRAMA DE CONFERENCIAS **/
    // Creamos el TAB para la seccion PROGRAMA EVENTO
    $('.programa-evento .info-curso:first').show();
    $('.menu-programa a:first').addClass('activo');

    $('.menu-programa a').on('click',function(){

        $('.menu-programa a').removeClass('activo');
        $(this).addClass('activo');
        $('.ocultar').hide();
        var enlace = $(this).attr('href');
        $(enlace).fadeIn(1000);
        
        return false;
    });

    /** CANTIDAD DE INVITADOS, TALLERES, DIAS y CONFERENCIAS **/
    // Agreramos animacion al los NUMEROS

    // PLUGIN - Animate Number
    // Comprobamos que la clase '.resumen-evento li' exista con una condicional. 
    if(document.querySelector('.resumen-evento li')){
        $('.resumen-evento li:nth-child(1) p').animateNumber({number: 6}, 1200);
        $('.resumen-evento li:nth-child(2) p').animateNumber({number: 15}, 1200);
        $('.resumen-evento li:nth-child(3) p').animateNumber({number: 3}, 1500);
        $('.resumen-evento li:nth-child(4) p').animateNumber({number: 9}, 1500);
    }
        
    /** FALTAN **/
    // Cuenta regresiva

    // PLUGIN - Countdownt
    // Comprobamos que la clase '.cuenta-regresiva' exista con una condicional. 
    if(document.querySelector('.cuenta-regresiva')){
        $('.cuenta-regresiva').countdown('2019/08/27 00:00:00', function(event){
            $('#dias').html(event.strftime('%D'));
            $('#horas').html(event.strftime('%H'));
            $('#minutos').html(event.strftime('%M'));
            $('#segundos').html(event.strftime('%S'));
        })
    }

    /** VENTANAS MODAL EN SECCION DE INVITADOS **/    
    // PLUGIN - Colorbox(Ventana Modal)
    if(document.querySelector('.invitado-info')){
        $('.invitado-info').colorbox({inline:true, width:"50%"});
    }

    /** FORMULARIO DE SUSCRIPCION EN UNA VENTANA MODAL EN SECCION **/    
    // PLUGIN - Colorbox(Ventana Modal) y Mailchimp(formulario)
    if(document.querySelector('.boton_newslleter')){
        $('.boton_newslleter').colorbox({inline:true, width:'50%'});
    }
    /** MENU FIJO **/
    // Hacemos que el menu al hacer scroll quede fijo a la pantalla
        
    // Con este codigo detectamos cuantos pixeles tiene la pantalla
    var windowHeight = $(window).height();
    // Con este codigo detectamos cuantos pixeles tiene el nodo seleccionado
    var barraAltura = $('.barra').innerHeight();
    // A la funcion "scroll()" le agregamos una funcion anonima
    $(window).scroll(function(){
        // Declaramos a la variable "scroll" la funcion "scrollTop", este va a ser el que detecte automaticamente los pixeles que vamos recorriendo en el sitio web.
        var scroll = $(window).scrollTop();
        // Si al dar "scroll" superamos los pixeles de la "pantalla" hacemos que el menu quede fijo
        if(scroll >  windowHeight){
            // Agregamos la clase "fixed" al nodo seleccionado
            $('.barra').addClass('fixed');
            // Le damos estilo al nodo seleccionado
            // Le agregamos un "margin-top" con el valor de la "altura del la barra de menu "al "body"
            $('body').css({'margin-top': barraAltura + 'px'});
        }else{
            // Quitamos la clase "fixed" al nodo seleccionado
            $('.barra').removeClass('fixed');
            // Le damos estilo al nodo seleccionado
            $('body').css({'margin-top':'0px'});
        }
    })

    // MENU RESPONSIVE
    $('.menu-movil').on('click', function(){
        // "slideToggle()" es una mescla de "slideDown()" y "slideUp()"
        $('.navegacion-principal').slideToggle();
    });

})