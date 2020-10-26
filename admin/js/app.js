$(function () { // Sintaxis de JQuery para que se ejecute la funcion cuando se termina de cargar la pagina

  // Tabla Dinamica - DataTable - Plugin.js
    $('#registros').DataTable({
      "responsive": true,
      "paging": true, // Paginación
      "lengthChange": true, // Tamaño de cantidad de registros que se muestran en la tabla
      "searching": true, // Buscadors
      "ordering": true, // Habilita la funcion Ordernar por Columna
      "order": [0, 'desc'], // La tabla se carga ordenando por la Columna 1 de manera Descendiente
      "info": true, // Informacion del total de registros que tiene la tabla
      "autoWidth": true, //Ajuste automatico del ancho
      "columnDefs": [{ // Configuramos la columna nro "0" para que sea invisible
            "targets": [ 0 ],
            "visible": false,
        }],
      "language": { // Formateamos el Idioma del Texto en la Tabla
        paginate: { 
          next: "Siguiente",
          previous: "Anterior",
          last: "Último",
          first: "Primero"
        },
        info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
        emptyTable: "No hay registros",
        infoEmpty: "Mostrando 0 a 0 de 0 resultados",
        lengthMenu: "Mostrar _MENU_ Registros",
        search: "Buscar: ",
        processing: "Procesando..."
      }
    });
// =========================================================================================================================================================

    // Desabilita el Botón
    $('#btn-enviar-admin').attr('disabled', true);

// =========================================================================================================================================================
//   Estilos Bootstrap de las validaciones del Formulario 
  $('input#password').on('input', function(){
      let password_nuevo = $('#repetir_password').val();
      if(password_nuevo != ''){   
        if($(this).val() == password_nuevo){
          $('#resultado_password').text('Correcto');
          $('#resultado_password').addClass('valid-feedback').removeClass('invalid-feedback');
          $('input#password').addClass('is-valid').removeClass('is-invalid');
          $('#repetir_password').addClass('is-valid').removeClass('is-invalid');
          $('#btn-enviar-admin').attr('disabled', false);
        }else{
          $('#resultado_password').text('¡No son iguales!');
          $('#resultado_password').addClass('is-invalid').removeClass('is-valid');
          $('input#password').addClass('is-invalid').removeClass('is-valid');
          $('#repetir_password').addClass('is-invalid').removeClass('is-valid');
          $('#resultado_password').addClass('invalid-feedback').removeClass('valid-feedback');
          $('#btn-enviar-admin').attr('disabled', true);
        }
      }
    });

    $('#repetir_password').on('input', function(){
        let password_nuevo = $('#password').val();
        if($(this).val() == password_nuevo){
          $('#resultado_password').text('Correcto');
          $('#resultado_password').addClass('valid-feedback').removeClass('invalid-feedback');
          $('input#password').addClass('is-valid').removeClass('is-invalid');
          $('#repetir_password').addClass('is-valid').removeClass('is-invalid');
          $('#btn-enviar-admin').attr('disabled', false);
        }else{
          $('#resultado_password').text('¡No son iguales!');
          $('#resultado_password').addClass('is-invalid').removeClass('is-valid');
          $('input#password').addClass('is-invalid').removeClass('is-valid');
          $('#repetir_password').addClass('is-invalid').removeClass('is-valid');
          $('#resultado_password').addClass('invalid-feedback').removeClass('valid-feedback');
          $('#btn-enviar-admin').attr('disabled', true);
        }
    });
// ==============================================================================================================================================
  // CAMPO FECHA / HORA

    //Mascara de campo fecha dd/mm/yyyy - Input Masck - Plugin.JS
    $('.datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });

    //Calendario - Date Picker Bootstrap - Plugin.JS
    $('.datepicker').datepicker({
      autoclose: true,  // En estado "TRUE" se cierra automaticamente al seleccionar la fecha
      format: 'dd/mm/yyyy' // Formato en el que se escribira la fecha en el campo
    });

    //Ingreso de Hora - Timepicker - Plugin.js
    $('.timepicker').datetimepicker({
      format: 'LT'
    });
// ==============================================================================================================================================
      //Combo box / Select Dinamico - Select2 - Plugin.js
      $('.select2').select2();
// ==============================================================================================================================================
      //Mini Cuadro de Iconos - IconPicker - Plugin.js
      $('.iconpicker').iconpicker();
      $("div.iconpicker-popover").removeClass('fade');
// ==============================================================================================================================================
      // Campo para cargar archivos - bs-custom-file-input - Plugin.js
      bsCustomFileInput.init();



  //Flat red color scheme for iCheck
  $('input[type="checkbox"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-blue'
  })

// ==============================================================================================================================================
    // Line Chart - Chart.js - Plugin.js

    if($('#grafica-registros')[0] != null){

      /* ChartJS
      * -------
      * Here we will create a few charts using ChartJS
      */

      // Se hace una peticion al servidor, soliciando como respuesta un objeto JSON
      $.getJSON('servicios/servicio-registrados.php')
        // Si la petición se realizo correctamente se ejecuta la funcion
        .done(function(data){

        // console.log(data); 

        // Se crea un nuevo array que contenga solo las fechas
        const registrados_fechas = data.map(element => {
           return element.fecha;
        });

        // Se crea un nuevo array que contenga solo la Cantidad de Registrados
        const registrados_cantidad = data.map(element => {
          return element.cantidad;
        });

        // Se crea un nuevo array que contenga solo la Cantidad de Registros Pagados
        const registros_pagados = data.map(element => {
          return element.pagados;
        });

        // Se crea un nuevo array que contenga solo la Ganancia de los Registros
        const registros_ganancia = data.map(element => {

          ganancia = (element.ganancia === null ? 0 : element.ganancia);
          return ganancia;
        });

          var areaChartData = {
            labels  : registrados_fechas,
            datasets: [
              {
                label               : 'Registrados',          // Nombre de la Linea Grafica
                backgroundColor     : 'rgba(60,141,188,0.9)', // Color del fondo de la grafica
                borderColor         : 'rgba(60,141,188,0.8)', // Color del borde de la grafica
                pointRadius          : true,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(60,141,188,1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data                : registrados_cantidad, // Datos que se ilustrarán en la grafica
                pointRadius: 5 // Se configura el tamaño de los puntos de la grafica
              },
              {
                label               : 'Pagados', // Nombre de la Linea Grafica
                backgroundColor     : '#ffc107', // Color del fondo de la grafica
                borderColor         : '#ffc107', // Color del borde de la grafica
                pointRadius         : true,
                pointColor          : '#ffc107',
                pointStrokeColor    : '#c1c7d1',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data                : registros_pagados, // Datos que se ilustrarán en la grafica
                pointRadius: 5 // Se configura el tamaño de los puntos de la grafica
              },
              {
                label               : 'Ganancias', // Nombre de la Linea Grafica
                backgroundColor     : '#28a745',   // Color del fondo de la grafica
                borderColor         : '#28a745',   // Color del borde de la grafica
                pointRadius         : true,
                pointColor          : '#28a745',
                pointStrokeColor    : '#c1c7d1',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data                : registros_ganancia, // Datos que se ilustrarán en la grafica
                pointRadius: 5 // Se configura el tamaño de los puntos de la grafica
              },
            ]
          }

          var areaChartOptions = {
            maintainAspectRatio : true, // Si se activa, se mantiene la relación de aspecto del lienzo original (ancho / alto) al cambiar el tamaño.
            responsive : true, // Se activa que sea responsive
            legend: {
              display: true // Activa la leyenda del encabezado
            },
            scales: {
              xAxes: [{
                gridLines : {
                  display : true, // Activa las lineas verticales del fondo
                }
              }],
              yAxes: [{
                gridLines : {
                  display : true, // Activa las lineas horizontales del fondo
                }
              }]
            },
            hover: {
              // Overrides the global setting
              mode: 'index'
          }
          }
    
          //-------------
          //- LINE CHART -
          //--------------
          var lineChartCanvas = $('#grafica-registros').get(0).getContext('2d')
          var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
          var lineChartData = jQuery.extend(true, {}, areaChartData)
          lineChartData.datasets[0].fill = false; // Agrega color al cuerpo del grafico (Cantidad Registrados)
          lineChartData.datasets[1].fill = false; // Agrega color al cuerpo del grafico (Pagados)
          lineChartData.datasets[2].fill = false; // Agrega color al cuerpo del grafico (Ganancias)
          lineChartOptions.datasetFill = false
    
          var lineChart = new Chart(lineChartCanvas, { 
            type: 'line',
            data: lineChartData, 
            options: lineChartOptions
          })
      });

    }

  });
