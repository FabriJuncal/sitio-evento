$(document).ready(function(){
    // Evento para Crear y Editar registro
    $('#guardar-registro').on('submit', function(e){
        e.preventDefault();
        
        // serializeArray(): Transforma los valores de los elementos de un formulario en una matriz de objetos de JavaScript,
        // lista para ser codigicada como una cadena JSON
        var  datos = $(this).serializeArray();
        
        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            success: function(data){  
                    console.log(data);
                    resultado = data;             
                    if(resultado.respuesta === 'exito'){
                        // Declaración Dinamica de Variable
                        accion = (resultado.accion == 'crear' ? 'creó' :
                                 (resultado.accion == 'editar' ? 'actualizó' : 'error'));
                        // Mensaje del Plugin.js - SweetAlert2
                        Swal.fire(
                            '¡CORRECTO!',
                            'El registro se ' + accion + ' correctamente',
                            'success'
                        );
                        // Ejecutamos una Funcion Anonima luego de 2000 Milisegundos
                        setTimeout(function(){
                            // Redirecciona al archivo "admin-area.php"
                            window.location.href = 'admin-area.php';
                        }, 2000);

                    }else{
                        // Mensaje del Plugin.js - SweetAlert2
                        Swal.fire(
                            '¡ERROR!',
                            'Algo salio mal',
                            'error'      
                        );
                    }
                }               
        });
    });
    // Evento para Crear y Editar registro
    $('#guardar-registro-archivo').on('submit', function(e){
        e.preventDefault();
        
        // FormData(): Crea un objeto y los ordena con una Clave y un Valor
        // lista para ser codigicada como una cadena JSON
        var  datos = new FormData(this); // Es necesario para cuando se quiera enviar Archivos
        
        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            contentType: false, //
            processData: false, //  Configuraciones Necesarias para enviar Archivos
            async:true,         // 
            cache: false,       // 
            success: function(data){  
                    console.log(data);
                    resultado = data;             
                    if(resultado.respuesta === 'exito'){
                        // Declaración Dinamica de Variable
                        accion = (resultado.accion == 'crear' ? 'creó' :
                                    (resultado.accion == 'editar' ? 'actualizó' : 'error'));
                        // Mensaje del Plugin.js - SweetAlert2
                        Swal.fire(
                            '¡CORRECTO!',
                            'El registro se ' + accion + ' correctamente',
                            'success'
                        );
                        // Ejecutamos una Funcion Anonima luego de 2000 Milisegundos
                        setTimeout(function(){
                            // Redirecciona al archivo "admin-area.php"
                            window.location.href = 'admin-area.php';
                        }, 2000);

                    }else{
                        // Mensaje del Plugin.js - SweetAlert2
                        Swal.fire(
                            '¡ERROR!',
                            'Algo salio mal',
                            'error'      
                        );
                    }
                }               
        });
    });   
    // Evento para Eliminar registro
    $('.borrar_registro').on('click', function(e){
        e.preventDefault();
        var ID = $(this).attr('data-id');
        var tipo = $(this).attr('data-tipo');
        // Mensaje del Plugin.js - SweetAlert2
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Un registro eliminado no se puede recuperar",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Si, eliminar!',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'post',
                    data: {
                        id_registro: ID,
                        registro: 'eliminar'
                    },
                    url: 'modelo-'+tipo+'.php',
                    dataType: 'json',
                    success: function(data){
                        console.log(data);
                        var resultado = data;   
                        if(resultado.respuesta == 'exito'){
                            Swal.fire(
                                '¡Eliminado!',
                                'Registro eliminado.',
                                'success'
                            );
                            $('a[data-id='+resultado.ID_eliminado+']').parents('tr').remove();
                        }else{
                            Swal.fire(
                                '¡Error!',
                                'Algo salio mal',
                                'error'
                            );
                        }        
                    }               
                });
            }
          })
    });


});