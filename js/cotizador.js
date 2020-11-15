(function () {
    "use strict";

    var regalo = document.getElementById('regalo');

    // Funcion que ejecuta el codigo cuando la pagina termina de cargar, es como el "ready" de jquery
    document.addEventListener('DOMContentLoaded', function () {

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

        var totalYaPagado = document.getElementById('total-pagado');

        // Extras
        var camisas = document.getElementById('camisa_evento');
        var etiquetas = document.getElementById('etiquetas');

        if (botonRegistro) {
            // Deshabilitamos el boton de Pagar
            botonRegistro.disabled = true;

        }
        // ======================================================================================================================================
        /***  EVENTOS  ***/

        // Se agrega una condicional para verificar que exista el elemento, en este caso es el ID "calcular"
        if (document.getElementById('calcular')) {
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
            nombre.addEventListener('blur', validaCampos);
            apellido.addEventListener('blur', validaCampos);
            email.addEventListener('blur', validaCampos);

            // Validamos el campo "Email", con la funcion "validaEmail", que se ejecutará con el evento "blur"
            email.addEventListener('blur', validaEmail);

            const formulario_editar = document.getElementsByClassName('editar-registrado');
            if(formulario_editar.length > 0){
                if (pase_dia.value || pase_dosdias.value || pase_completo.value) {
                    mostrarDias();
                    calcularMontos();
                }
            }

        } 
        // ======================================================================================================================================
        /***  FUNCIONES  ***/

        // Calcula el monto segun de la seleccion del usuario y los muestra en el DOM
        function calcularMontos(event) {
            
            if (event){
                event.preventDefault();
            }
            
            if (regalo.value === '') {
                alert("Debes elegir un regalo");
                regalo.focus();
            } else {
                // Agregamos parseInt() para truncar los números en valores enteros
                var boletosDia = parseInt(pase_dia.value, 10) || 0,
                    boletos2Dias = parseInt(pase_dosdias.value, 10) || 0,
                    boletosCompleto = parseInt(pase_completo.value, 10) || 0,
                    cantCamisas = parseInt(camisas.value, 10) || 0,
                    cantEtiquetas = parseInt(etiquetas.value, 10) || 0;
                
                // Calculamos el Total a Pagar
                var totalPagar = (boletosDia * 30) + (boletos2Dias * 45) + (boletosCompleto * 50) + ((cantCamisas * 10) * .93) + (cantEtiquetas * 2);
                var listadoProductos = [];

                if (document.getElementById('total-pagado')) {
                    let totalYaPagadoValor = parseFloat(totalYaPagado.textContent);
                    totalPagar = parseFloat(totalPagar - totalYaPagadoValor);
                    document.getElementById('total_pedido').value = totalPagar + totalYaPagadoValor;
                }

                // Se cargan los dias que se asignaron distinto de cero
                if (boletosDia >= 1) {
                    listadoProductos.push(boletosDia + ' Pases por día');
                }
                if (boletos2Dias >= 1) {
                    listadoProductos.push(boletos2Dias + ' Pases por 2 día');
                }
                if (boletosCompleto >= 1) {
                    listadoProductos.push(boletosCompleto + ' Pases por Completos');
                }
                if (cantCamisas >= 1) {
                    listadoProductos.push(cantCamisas + ' Camisas');
                }
                if (cantEtiquetas >= 1) {
                    listadoProductos.push(cantEtiquetas + ' Etiquetas');
                }

                // Mostramos la lista del Resumen
                lista_productos.style.display = 'block';
                lista_productos.innerHTML = '';
                for (var i = 0; i < listadoProductos.length; i++) {
                    lista_productos.innerHTML += listadoProductos[i] + '<br/>';
                }

                // Mostramos el total a pagar
                suma_total.innerHTML = '$ ' + totalPagar.toFixed(2);

                if (botonRegistro) {
                    // Habilitamos el boton de Pagar
                    botonRegistro.disabled = false;

                }
            }
        }

        // Valida según el boleto seleccionado y muestra los días con sus respectivos eventos
        function mostrarDias() {
            // Agregamos parseInt() para truncar los números en valores enteros.
            var boletosDia = parseInt(pase_dia.value, 10) || 0,
                boletos2Dias = parseInt(pase_dosdias.value, 10) || 0,
                boletosCompleto = parseInt(pase_completo.value, 10) || 0;

            var diasElegidos = [];

            //Cargamos en un Array[] los dias segun la opcion que elijamos, para despues mostrarlos u ocultarlos

            if (boletosDia > 0) {
                diasElegidos.push('viernes');
                if (boletos2Dias == 0) {
                    document.getElementById('sabado').style.display = 'none';
                }
                if (boletosCompleto == 0) {
                    document.getElementById('sabado').style.display = 'none';
                    document.getElementById('domingo').style.display = 'none';
                }
            } else {
                document.getElementById('viernes').style.display = 'none';
            }

            if (boletos2Dias > 0) {
                diasElegidos.push('viernes', 'sabado');
                if (boletosCompleto == 0) {
                    document.getElementById('domingo').style.display = 'none';
                }
            } else {
                document.getElementById('viernes').style.display = 'none';
                document.getElementById('sabado').style.display = 'none';
            }

            if (boletosCompleto > 0) {
                diasElegidos.push('viernes', 'sabado', 'domingo');
            } else {
                document.getElementById('viernes').style.display = 'none';
                document.getElementById('sabado').style.display = 'none';
                document.getElementById('domingo').style.display = 'none';
            }

            for (var i = 0; i < diasElegidos.length; i++) {
                document.getElementById(diasElegidos[i]).style.display = 'flex';
            }

        }

        // Valida los campos obligatorios y muestra una alerta en el DOM en el caso que no se haya completado algun campo
        function validaCampos() {
            // Se declara la variable y se le asigna el nodo donde se ejecuto el evento.
            // con ('error_' + this.id) logramos conseguir el nombre del ID al que se va a seleccionar el Nodo
            if(document.querySelector('.seccion #error_' + this.id)){
                var errorDiv = document.querySelector('.seccion #error_' + this.id); // Ejemplo: .seccion #error_nombre
                // Se declara la variable y se le asigna el 2do hijo del nodo con ":nth-child(2)". 
                var texto = document.querySelector('.seccion #error_' + this.id + ' span:nth-child(2)');  // Ejemplo: .seccion #error_nombre span:nth-child(2)                 
                if (this.value == '') {
                    //Insertamos el siguiente texto en el nodo antes de mostrarlo
                    texto.innerText = 'Campo obligatorio';
                    errorDiv.style.display = 'block';
                } else {
                    errorDiv.style.display = 'none';
                }
            }

        }
        // Valida el formato del email y muestra una alerta en el DOM en el caso que no tenga un formato correcto
        function validaEmail() {
            // Se declara la variable y se le asigna el nodo donde se ejecuto el evento.
            // con la funcion "indexOf" le pasamos como parametro un caracter y verificará si existe en el campo, en el caso
            // que no exista nos devolvera como resultado "-1" y en el caso que exista devolvera "0".
            var errorDiv = document.querySelector('.seccion #error_email'); // Ejemplo: .seccion #error_nombre p 
            var texto = document.querySelector('.seccion #error_email span:nth-child(2)');
            if (this.value != '') {
                if (this.value.indexOf('@') == -1) {
                    //Insertamos el siguiente texto en el nodo antes de mostrarlo
                    texto.innerText = 'El campo debe tener una "@"';
                    errorDiv.style.display = 'block';
                } else {
                    errorDiv.style.display = 'none';

                }
            }
        }

    }) // DOM CONTENT LOADED;
})();