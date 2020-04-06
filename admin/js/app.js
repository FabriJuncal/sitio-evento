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
      

  });
