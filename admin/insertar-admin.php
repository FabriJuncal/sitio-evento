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