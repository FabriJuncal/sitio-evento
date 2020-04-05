<?php

include_once "funciones/funciones.php";
// Comprobamos si estamos conectados a la base de datos:
                                                        // if($conn->ping()){
                                                        //     die("Conectado");
                                                        // }{
                                                        //     die("Desconectado");
                                                        // }

// Datos Obtenidos del POST
$id_registro = (isset($_POST['id_registro']) ? $_POST['id_registro'] : null);
$nombre = (isset($_POST['nombre_invitado']) ? $_POST['nombre_invitado'] : null);
$apellido = (isset($_POST['apellido_invitado']) ? $_POST['apellido_invitado'] : null);
$biografia = (isset($_POST['biografia_invitado']) ? $_POST['biografia_invitado'] : null);


// ABM Usuarios
if(isset($_POST['registro'])){
    
    // $respuesta = array(
    //     'post' => $_POST, // Accedemos a los Datos
    //     'file' => $_FILES // Accedemos a los Archivos
    // );
    // die(json_encode($respuesta));

    // Crea un Invitado
    if($_POST['registro'] == 'crear'){

        // Ruta donde se almacenarán las Imagenes
        $directorio = "../img/invitados/";

        // is_dir(): Verifica que exista el directorio
        if(!is_dir($directorio  )){
            // mkdir(): Crea el directorio
            // Parametro 1: Ruta del Directorio
            // Parametro 2: Codigo del permiso de acceso (Por lo general en los Servidores Web se utiliza el codigo "0755")
            // Parametro 3: Configuramos para que sea Recursivo o no, es decir, en el caso de Si, todos los Subdirectorios de este obtendran el mismo Codigo de Permiso
            // sino, se tendran que asignar el Codigo de Permiso a cada Subdirectorio creado
            mkdir($directorio, 0755, true);
        }

        // move_uploaded_file(): Mueve archivos
        // Parametro 1: Ruta temporal
        // Parametro 2: Ruta actual adonde queremos enviar el Archivo
        if(move_uploaded_file($_FILES['imagen_invitado']['tmp_name'], $directorio . $_FILES['imagen_invitado']['name'])){ // En el caso que se movio correctamente

            $imagen_url = $_FILES['imagen_invitado']['name']; // Almacenamos en la Base de Datos la Ruta Final del Archivo
            $imagen_resultado = "Se subió correctamente";

        }else{ // En el caso que no se pudo mover el archivo

            $respuesta = array(
                // error_get_last(): Devuelve el ultimo error encontrado
                'respuesta' => error_get_last()
            );
        }

        try{
            $stmt = $conn->prepare("INSERT INTO invitados (nombre_invitado, apellido_invitado, descripcion, url_imagen) VALUES (?,?,?,?)");
            $stmt->bind_param("ssss", $nombre, $apellido, $biografia, $imagen_url);
            $stmt->execute();
            if($stmt->affected_rows > 0){
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_accion' => $stmt->insert_id,
                    'resultado_imagen' => $imagen_resultado,
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

        // Ruta donde se almacenarán las Imagenes
        $directorio = "../img/invitados/";

        // is_dir(): Verifica que exista el directorio
        if(!is_dir($directorio  )){
            // mkdir(): Crea el directorio
            // Parametro 1: Ruta del Directorio
            // Parametro 2: Codigo del permiso de acceso (Por lo general en los Servidores Web se utiliza el codigo "0755")
            // Parametro 3: Configuramos para que sea Recursivo o no, es decir, en el caso de Si, todos los Subdirectorios de este obtendran el mismo Codigo de Permiso
            // sino, se tendran que asignar el Codigo de Permiso a cada Subdirectorio creado
            mkdir($directorio, 0755, true);
        }

        // move_uploaded_file(): Mueve archivos
        // Parametro 1: Ruta temporal
        // Parametro 2: Ruta actual adonde queremos enviar el Archivo
        if(move_uploaded_file($_FILES['imagen_invitado']['tmp_name'], $directorio . $_FILES['imagen_invitado']['name'])){ // En el caso que se movio correctamente

            $imagen_url = $_FILES['imagen_invitado']['name']; // Almacenamos en la Base de Datos la Ruta Final del Archivo
            $imagen_resultado = "Se subió correctamente";

        }else{ // En el caso que no se pudo mover el archivo

            $respuesta = array(
                // error_get_last(): Devuelve el ultimo error encontrado
                'respuesta' => error_get_last()
            );
        }
        try{

            if($_FILES['imagen_invitado']['size'] > 0){  // En el caso que se Modifique la Imagen

                $stmt = $conn->prepare("UPDATE invitados 
                                        SET nombre_invitado = ?, apellido_invitado = ?, descripcion = ?, url_imagen = ?, editado = NOW()
                                        WHERE invitado_id = ?");
                $stmt->bind_param("ssssi", $nombre, $apellido, $biografia, $imagen_url, $id_registro);

            }else{ // En el caso que no se Modifique la Imagen

                $stmt = $conn->prepare("UPDATE invitados 
                                        SET nombre_invitado = ?, apellido_invitado = ?, descripcion = ?, editado = NOW()
                                        WHERE invitado_id = ?");
                $stmt->bind_param("sssi", $nombre, $apellido, $biografia, $id_registro);
            }

            $stmt->execute();
            if($stmt->affected_rows > 0){              
                $respuesta = array(
                    'respuesta' => 'exito',
                    'accion' => $_POST['registro'],
                    'ID_actualizado' => $id_registro
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

        try{
            $stmt = $conn->prepare("DELETE FROM invitados WHERE invitado_id = ?");
            $stmt->bind_param("i", $id_registro);
            $stmt->execute();
            if($stmt->affected_rows > 0){
                $respuesta = array(
                    'respuesta' => 'exito',
                    'accion' => $_POST['registro'],
                    'ID_eliminado' => $id_registro

                );
            }else{
                $respuesta = array(
                    'respuesta' => 'error'
                );
            }
        }catch(Exception $e){
            $respuesta = array(
                'respuesta' => $e->getMessage()
            );
        }

        die(json_encode($respuesta));
    }
}
