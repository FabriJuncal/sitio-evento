<?php

include_once "funciones/funciones.php";
// Comprobamos si estamos conectados a la base de datos:
// if($conn->ping()){
//     die("Conectado");
// }{
//     die("Desconectado");
// }

// Datos Obtenidos del POST

$nombre_registrado = $_POST['nombre_registrado'] ?? null;
$apellido_registrado = $_POST['apellido_registrado'] ?? null;
$email_registrado = $_POST['email_registrado'] ?? null;

$boletos_adquiridos = $_POST['boletos'] ??  null;
$camisas = $_POST['pedido_extra']['camisas']['cantidad'] ??  null;
$etiquetas = $_POST['pedido_extra']['etiquetas']['cantidad'] ??  null;

$pedido = productos_json($boletos_adquiridos, $camisas, $etiquetas);

$eventos = $_POST['registro_evento'] ?? null;
$registro_eventos = eventos_json($eventos);

$regalo = $_POST['regalo'] ?? null;

$total = $_POST['total_pedido'] ?? null;

$fecha_registro = $_POST['fecha_registro'] ?? null;

$id_registro = $_POST['id_registro'] ?? null;

// ABM Usuarios
if(isset($_POST['registro'])){
    
    // Crea un Usuario
    if($_POST['registro'] == 'crear'){

        // $respuesta = array(
        //     'boletos' => $pedido
        // );

        die(json_encode($_POST));

        try{
            $stmt = $conn->prepare("INSERT INTO registrados (nombre_registrado, 
                                                            apellido_registrado,
                                                            email_registrado, 
                                                            fecha_registro, 
                                                            pases_articulos, 
                                                            talleres_registrados, 
                                                            regalo, 
                                                            total_pagado, 
                                                            pagado) 
                                        VALUES (?,?,?,NOW(),?,?,?,?,1)");

            $stmt->bind_param("sssssis",
                                $nombre_registrado, 
                                $apellido_registrado, 
                                $email_registrado, 
                                $pedido, 
                                $registro_eventos, 
                                $regalo, 
                                $total);

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
            $stmt = $conn->prepare("UPDATE registrados 	 	 	 	 	 	 	 	
                                    SET nombre_registrado = ?,
                                        apellido_registrado = ?, 
                                        email_registrado = ?, 
                                        fecha_registro = ?, 
                                        pases_articulos = ?, 
                                        talleres_registrados = ?, 
                                        regalo = ?, 
                                        total_pagado = ?, 
                                        pagado = 1
                                    WHERE ID_Registrado = ?");
            $stmt->bind_param("ssssssisi",
                                $nombre_registrado,
                                $apellido_registrado, 
                                $email_registrado, 
                                $fecha_registro, 
                                $pedido,
                                $registro_eventos,
                                $regalo,
                                $total,
                                $id_registro);
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
            $stmt = $conn->prepare("DELETE FROM registrados WHERE ID_Registrado = ?");
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
