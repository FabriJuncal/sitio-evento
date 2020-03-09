$(function () { // Sintaxis de JQuery para que se ejecute la funcion cuando se termina de cargar la pagina
  // Iniciación de la tabla del Plugin.js DataTable.js
    $('#registros').DataTable({
      "paging": true, // Paginación
      "lengthChange": true, // Tamaño de cantidad de registros que se muestran en la tabla
      "searching": true, // Buscadors
      "ordering": true, // Ordernar
      "info": true, // Informacion del total de registros que tiene la tabla
      "autoWidth": true, //Ajuste automatico del ancho
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

    $('#btn-enviar').attr('disabled', true);

    $('input#password').on('input', function(){
      let password_nuevo = $('#repetir_password').val();
      if(password_nuevo != ''){   
        if($(this).val() == password_nuevo){
          $('#resultado_password').text('Correcto');
          $('#resultado_password').addClass('valid-feedback').removeClass('invalid-feedback');
          $('input#password').addClass('is-valid').removeClass('is-invalid');
          $('#repetir_password').addClass('is-valid').removeClass('is-invalid');
          $('#btn-enviar').attr('disabled', false);
        }else{
          $('#resultado_password').text('¡No son iguales!');
          $('#resultado_password').addClass('is-invalid').removeClass('is-valid');
          $('input#password').addClass('is-invalid').removeClass('is-valid');
          $('#repetir_password').addClass('is-invalid').removeClass('is-valid');
          $('#resultado_password').addClass('invalid-feedback').removeClass('valid-feedback');
          $('#btn-enviar').attr('disabled', true);
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
          $('#btn-enviar').attr('disabled', false);
        }else{
          $('#resultado_password').text('¡No son iguales!');
          $('#resultado_password').addClass('is-invalid').removeClass('is-valid');
          $('input#password').addClass('is-invalid').removeClass('is-valid');
          $('#repetir_password').addClass('is-invalid').removeClass('is-valid');
          $('#resultado_password').addClass('invalid-feedback').removeClass('valid-feedback');
          $('#btn-enviar').attr('disabled', true);
        }
    });

    

  });



    // VALIDACION DE CAMPOS DEL FORMULARIO DE BOOTSTRAP
    //   // Ejemplo de JavaScript de inicio para deshabilitar los envíos de formularios si hay campos no válidos
    //   window.addEventListener('load', function() {
    //     // Obtenga todos los formularios a los que queremos aplicar estilos personalizados de validación Bootstrap
    //     var forms = $('needs-validation');
    //     // Bucle sobre ellos y evitar la presentación
    //     var validation = Array.prototype.filter.call(forms, function(form) {
    //       form.addEventListener('submit', function(event) {
    //         if (form.checkValidity() === false) {
    //           event.preventDefault();
    //           event.stopPropagation();
    //         }
    //         form.classList.add('was-validated');
    //       }, false);
    //     });
    //   }, false);