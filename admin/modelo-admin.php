<?php

include_once "funciones/funciones.php";
// Comprobamos si estamos conectados a la base de datos:
                                                        // if($conn->ping()){
                                                        //     die("Conectado");
                                                        // }{
                                                        //     die("Desconectado");
                                                        // }

// Datos Obtenidos del POST
$usuario = (isset($_POST['usuario']) ? $_POST['usuario'] : null);
$nombre = (isset($_POST['nombre']) ? $_POST['nombre'] : null);
$password = (isset($_POST['password']) ? $_POST['password'] : null);
$id_registro = (isset($_POST['ID_registro']) ? $_POST['ID_registro'] : null);

// ABM Usuarios
if(isset($_POST['registro'])){
    // Crea un Usuario
    if($_POST['registro'] == 'crear'){

        $opciones = array(
            'cost' => 12
        );
        //password_hash(): Funcion para encriptar la contraseña, siempre devuelve un string de 60 caracteres.
        //                 El parametro "opciones" representa el costo de la encriptacion, cuanto mas costo, mas segura es.
        $password_hashed = password_hash($password, PASSWORD_BCRYPT, $opciones);
        try{
            $stmt = $conn->prepare("INSERT INTO admins (usuario, nombre, password) VALUES (?,?,?)");
            $stmt->bind_param("sss", $usuario, $nombre, $password_hashed);
            $stmt->execute();
            if($stmt->affected_rows > 0){
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_accion' => $stmt->insert_id,
                    'accion' => $_POST['registro']
                );
            }else{
                $respuesta = array(
                    'respuesta' => 'error'
                );
            }
            $stmt->close();
            $conn->close();
        }catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }

        die(json_encode($respuesta));
    }
    // Modifica el Usuario
    if($_POST['registro'] == 'editar'){

        try{
            if(empty($_POST['password'])){
                $stmt = $conn->prepare("UPDATE admins SET usuario = ?, nombre = ?, editado = NOW() WHERE id_admin = ?");
                $stmt->bind_param("ssi", $usuario, $nombre, $id_registro);
            }else{
                $opciones = array(
                    'cost' => 12
                );
                //password_hash(): Funcion para encriptar la contraseña, siempre devuelve un string de 60 caracteres.
                //                 El parametro "opciones" representa el costo de la encriptacion, cuanto mas costo, mas segura es.
                $password_hashed = password_hash($password, PASSWORD_BCRYPT, $opciones);
                $stmt = $conn->prepare("UPDATE admins SET usuario = ?, nombre = ?, password = ?, editado = NOW() WHERE id_admin = ?");
                $stmt->bind_param("sssi", $usuario, $nombre, $password_hashed, $id_registro);
            }

            $stmt->execute();
            if($stmt->affected_rows > 0){
                $respuesta = array(
                    'respuesta' => 'exito',
                    'accion' => $_POST['registro']
                );
            }else{
                $respuesta = array(
                    'respuesta' => 'error'
                );
            }
            $stmt->close();
            $conn->close();
        }catch(Exception $e){
            $respuesta = array(
                'respuesta' => $e->getMessage()
            );
        }

        die(json_encode($respuesta));
    }
    // ELiminar el Usuario
    if($_POST['registro'] == 'eliminar'){

        // try{
        //     $stmt = $conn->prepare("DELETE FROM admins WHERE id_admin = ?");
        //     $stmt->bind_param("i", $id_registro);
        //     $stmt->execute();
        //     if($stmt->affected_rows > 0){
        //         $respuesta = array(
        //             'respuesta' => 'exito',
        //             'ID_eliminado' => $id_registro,
        //             'accion' => $_POST['registro']
        //         );
        //     }else{
        //         $respuesta = array(
        //             'respuesta' => 'error'
        //         );
        //     }
        // }catch(Exception $e){
        //     $respuesta = array(
        //         'respuesta' => $e->getMessage()
        //     );
        // }

        die(json_encode($id_registro));
    }
}
// Logea al Usuario
if(isset($_POST['login-admin'])){
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    try{
        include_once "funciones/funciones.php";
        $stmt = $conn->prepare("SELECT id_admin, usuario, nombre, password FROM admins WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $stmt->bind_result($id_admin, $usuario_admin, $nombre_admin, $password_admin);
        if($stmt->affected_rows){
            $existe = $stmt->fetch();
            if($existe){
                //password_verify(): Funcion que realiza la conversion de la contraseña y compara con la contraseña encriptada
                // 1er parametro($password): Contraseña desencriptada que incresa el usuario.
                // 2do parametreo($password_admin): Contraseña encriptada que se encuentra almacenada en la base de datos
                if(password_verify($password, $password_admin)){
                    // Iniciamos la Sesion cuando el Login es correcto
                    session_start();
                    // Cargamos los datos en la variable "$_SESSION" y esta se almacena en el servidor
                    $_SESSION['usuario'] = $usuario_admin;
                    $_SESSION['nombre'] = $nombre_admin;

                    $respuesta = array(
                        'respuesta' => 'exito',
                        'nombre' => $nombre_admin
                    );
                }else{
                    // No coincide la Contraseña
                    $respuesta = array(
                        'respuesta' => 'error'
                    );
                }
            }else{
                // No se encuentra el Usuario
                $respuesta = array(
                    'respuesta' => 'error'
                );
            }
        }
        $stmt->close();
        $conn->close();
    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
    }

    die(json_encode($respuesta));
}