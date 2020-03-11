<?php
// Logea al Usuario
if(isset($_POST['login-admin'])){
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    try{
        include_once "funciones/funciones.php";
        $stmt = $conn->prepare("SELECT id_admin, usuario, nombre, password, nivel FROM admins WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $stmt->bind_result($id_admin, $usuario_admin, $nombre_admin, $password_admin, $nivel);
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
                    $_SESSION['id_admin'] = $id_admin;
                    $_SESSION['usuario'] = $usuario_admin;
                    $_SESSION['nombre'] = $nombre_admin;
                    $_SESSION['nivel'] = $nivel;

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