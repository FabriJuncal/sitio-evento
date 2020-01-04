(function(){
    "use strict";

    var regalo = document.getElementById('regalo');

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
// ======================================================================================================================================
        /***  SELECCIONES DE NODOS ***/

        // Seleccionamos los IDs y los declaramos a las variables respectivas
        // Campos Datos Usuario
        var nombre = document.getElementById('nombre');
        var apellido = document.getElementById('apellido');
        var email = document.getElementById('email');

        // Campos Pases
        var pase_dia = document.getElementById('pase_dia');
        var pase_dosdias = document.getElementById('pase_dosdias');
        var pase_completo = document.getElementById('pase_completo');
        
        // Botones y Divs
        var calcular = document.getElementById('calcular');
        var error_nombre = document.getElementById('error_nombre');
        var error_apellido = document.getElementById('error_apellido');
        var error_email = document.getElementById('error_email');
        var botonRegistro = document.getElementById('btnRegistro');
        var lista_productos = document.getElementById('lista-productos');
        var suma_total = document.getElementById('suma-total');

        // Extras
        var camisas = document.getElementById('camisa_evento');
        var etiquetas = document.getElementById('etiquetas');

        if(botonRegistro){
            // Deshabilitamos el boton de Pagar
            botonRegistro.disabled = true;
        
        }
        

// ======================================================================================================================================
        /***  EVENTOS  ***/

        // Se agrega una condicional para verificar que exista el elemento, en este caso es el ID "calcular"
        if(document.getElementById('calcular')){
            // Funcion cuando se hace 'click' en el boton calcular
            // Al ID 'calcular' le asignamos una funcion llamada 'calcularMontos' en el evento 'click' con la funcion 'addEventListener'
            calcular.addEventListener('click', calcularMontos);

            // Al los IDs de Pase de Dias le asignamos una funcion llamada 'mostrarDias' en el evento 'input' con la funcion 'addEventListener'
            // El evento 'input' actua cuando se modifica el valor del campo.
            pase_dia.addEventListener('input', mostrarDias);
            pase_dosdias.addEventListener('input', mostrarDias);
            pase_completo.addEventListener('input', mostrarDias);

            // Al los IDs de Pase de Dias le asignamos una funcion llamada 'validaCampos' en el evento 'blur' con la funcion 'addEventListener'
            // El evento 'blur' actua cuando se sale del campo.
            nombre.addEventListener('blur',validaCampos);
            apellido.addEventListener('blur',validaCampos);
            email.addEventListener('blur',validaCampos);

            // Validamos el campo "Email", con la funcion "validaEmail", que se ejecutará con el evento "blur"
            email.addEventListener('blur',validaEmail);
        }   
// ======================================================================================================================================
        /***  FUNCIONES  ***/

        function calcularMontos(event){
            event.preventDefault();
            if(regalo.value === ''){
                alert("Debes elegir un regalo");
                regalo.focus();
            }else{
                // Agregamos parseInt() para truncar los números en valores enteros
                var boletosDia = parseInt(pase_dia.value,10) || 0,
                    boletos2Dias = parseInt(pase_dosdias.value,10) || 0,
                    boletosCompleto = parseInt(pase_completo.value,10) || 0,
                    cantCamisas = parseInt(camisas.value,10) || 0,
                    cantEtiquetas = parseInt(etiquetas.value,10) || 0;

                // Calculamos el Total a Pagar
                var totalPagar = (boletosDia * 30) + (boletos2Dias * 45) + (boletosCompleto * 50) + ((cantCamisas * 10) * .93) + (cantEtiquetas * 2);
                
                var listadoProductos = [];

                // Se cargan los dias que se asignaron distinto de cero
                if(boletosDia >= 1){
                    listadoProductos.push(boletosDia + ' Pases por día');
                }
                if(boletos2Dias >= 1){
                    listadoProductos.push(boletos2Dias + ' Pases por 2 día');
                }
                if(boletosCompleto >= 1){
                    listadoProductos.push(boletosCompleto + ' Pases por Completos');
                }
                if(cantCamisas >= 1){
                    listadoProductos.push(cantCamisas + ' Camisas');
                }
                if(cantEtiquetas >= 1){
                    listadoProductos.push(cantEtiquetas + ' Etiquetas');
                }

                // Mostramos la lista del Resumen
                lista_productos.style.display = 'block';
                lista_productos.innerHTML = '';
                for(var i = 0; i < listadoProductos.length; i++){
                    lista_productos.innerHTML += listadoProductos[i] + '<br/>';
                }

                // Mostramos el total a pagar
                suma_total.innerHTML = '$ ' + totalPagar.toFixed(2);

                if(botonRegistro){
                    // Habilitamos el boton de Pagar
                    botonRegistro.disabled = false;
                
                }

                document.getElementById('total_pedido').value = totalPagar;
            }
        }

        function mostrarDias(){
            // Agregamos parseInt() para truncar los números en valores enteros.
            var boletosDia = parseInt(pase_dia.value,10) || 0,
                boletos2Dias = parseInt(pase_dosdias.value,10) || 0,
                boletosCompleto = parseInt(pase_completo.value,10) || 0;

            var diasElegidos = [];

            //Cargamos en un Array[] los dias segun la opcion que elijamos, para despues mostrarlos u ocultarlos

            if(boletosDia > 0){
                diasElegidos.push('viernes');
                if(boletos2Dias == 0){
                    document.getElementById('sabado').style.display = 'none';
                }
                if(boletosCompleto == 0){
                    document.getElementById('sabado').style.display = 'none';
                    document.getElementById('domingo').style.display = 'none';
                }
            }else{
                document.getElementById('viernes').style.display = 'none';
            }

            if(boletos2Dias > 0){
                diasElegidos.push('viernes','sabado');
                if(boletosCompleto == 0){
                    document.getElementById('domingo').style.display = 'none';
                }
            }else{
                document.getElementById('viernes').style.display = 'none';
                document.getElementById('sabado').style.display = 'none';
            }

            if(boletosCompleto > 0){
                diasElegidos.push('viernes','sabado','domingo');
            }else{
                document.getElementById('viernes').style.display = 'none';
                document.getElementById('sabado').style.display = 'none';
                document.getElementById('domingo').style.display = 'none';
            }

            for(var i = 0; i < diasElegidos.length; i++){
                document.getElementById(diasElegidos[i]).style.display = 'block';
            }
            
        }

        function validaCampos(){
            // Se declara la variable y se le asigna el nodo donde se ejecuto el evento.
            // con ('error_' + this.id) logramos conseguir el nombre del ID al que se va a seleccionar el Nodo
            var errorDiv = document.querySelector('.seccion #error_' + this.id); // Ejemplo: .seccion #error_nombre
            // Se declara la variable y se le asigna el 2do hijo del nodo con ":nth-child(2)". 
            var texto = document.querySelector('.seccion #error_'+ this.id + ' span:nth-child(2)');  // Ejemplo: .seccion #error_nombre span:nth-child(2)                 
            if(this.value == ''){ 
                //Insertamos el siguiente texto en el nodo antes de mostrarlo
                texto.innerText = 'Campo obligatorio';     
                errorDiv.style.display ='block';
            }else{
                errorDiv.style.display ='none';
            } 
        }

        function validaEmail(){
            // Se declara la variable y se le asigna el nodo donde se ejecuto el evento.
            // con la funcion "indexOf" le pasamos como parametro un caracter y verificará si existe en el campo, en el caso
            // que no exista nos devolvera como resultado "-1" y en el caso que exista devolvera "0".
            var errorDiv = document.querySelector('.seccion #error_email'); // Ejemplo: .seccion #error_nombre p 
            var texto = document.querySelector('.seccion #error_email span:nth-child(2)');
            if(this.value != ''){   
                if(this.value.indexOf('@') == -1){
                    //Insertamos el siguiente texto en el nodo antes de mostrarlo
                    texto.innerText = 'El campo debe tener una "@"';
                    errorDiv.style.display ='block';
                }else{
                    errorDiv.style.display ='none';

                }
            }
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
    $('.boton_newslleter').colorbox({inline:true, width:'50%'});

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