$(document).ready(function(){
    $('#login-admin').on('submit', function(e){
        e.preventDefault();
        
        var  datos = $(this).serializeArray();
        
        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            success: function(data){
                var resultado = data;
                if(resultado.respuesta === 'exito'){
                    // Mensaje del Plugin.js - SweetAlert2
                    Swal.fire(
                        'Login Correcto',
                        '¡Bienvenid@ '+resultado.nombre+'!',
                        'success'
                    );
                    // La Funcion Anonima se ejecuta luego de 2000 milisegundos
                    setTimeout(function(){
                        // Redirecciona al archivo "admin-area.php"
                        window.location.href = 'admin-area.php';
                    }, 2000);
                }else{
                     // Mensaje del Plugin.js - SweetAlert2
                    Swal.fire(
                        '¡ERROR!',
                        'Usuario o Contraseña incorrecto',
                        'error'      
                    );
                }
            }
        });
    });
});