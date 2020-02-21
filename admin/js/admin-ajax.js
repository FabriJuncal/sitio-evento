$(document).ready(function(){
    $('#crear-admin').on('submit', function(e){
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
                    Swal.fire(
                        '¡CORRECTO!',
                        'El administrador se creo correctamente',
                        'success'
                    )
                }else{
                    Swal.fire(
                        '¡ERROR!',
                        'Algo salio mal',
                        'error'      
                    )
                }
            }
        })
    });


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
                    Swal.fire(
                        'Login Correcto',
                        '¡Bienvenid@ '+resultado.nombre+'!',
                        'success'
                    )

                    setTimeout(function(){
                        window.location.href = 'admin-area.php';
                    }, 2000);
                }else{
                    Swal.fire(
                        '¡ERROR!',
                        'Usuario o Contraseña incorrecto',
                        'error'      
                    )
                }
            }
        })
    });
});