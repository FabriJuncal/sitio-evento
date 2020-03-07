$(document).ready(function(){
    $('#guardar-registro').on('submit', function(e){
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
                        // Variable Dinamica
                        accion = (resultado.accion == 'crear' ? 'creó' :
                                 (resultado.accion == 'editar' ? 'actualizó' :
                                 (resultado.accion == 'eliminar' ? 'eliminó' : 'error')));

                        Swal.fire(
                            '¡CORRECTO!',
                            'El administrador se ' + accion + ' correctamente',
                            'success'
                        );
                    }else{
                        Swal.fire(
                            '¡ERROR!',
                            'Algo salio mal',
                            'error'      
                        );
                    }
                }               
            });
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