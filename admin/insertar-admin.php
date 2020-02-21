<?php

// include_once "funciones/funciones.php";
// Comprobamos si estamos conectados a la base de datos
// if($conn->ping()){
//     die("Conectado");
// }{
//     die("Desconectado");
// }
if(isset($_POST['agregar-admin'])){
    $usuario = $_POST['usuario'];
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];

    $opciones = array(
        'cost' => 12
    );

    //password_hash(): Funcion para encriptar la contraseña, siempre devuelve un string de 60 caracteres.
    //                 El parametro "opciones" representa el costo de la encriptacion, cuanto mas costo, mas segura es.
    $password_hashed = password_hash($password, PASSWORD_BCRYPT, $opciones);

    try{
        include_once "funciones/funciones.php";
        $stmt = $conn->prepare("INSERT INTO admins (usuario, nombre, password) VALUES (?,?,?)");
        $stmt->bind_param("sss", $usuario, $nombre, $password_hashed);
        $stmt->execute();
        

        if($stmt->affected_rows > 0){

            $id_registro = $stmt->insert_id;

            $respuesta = array(
                'respuesta' => 'exito',
                'id_admin' => $id_registro
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

if(isset($_POST['login-admin'])){
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    try{
        include_once "funciones/funciones.php";
        $stmt = $conn->prepare("SELECT * FROM admins WHERE usuario = ?");
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