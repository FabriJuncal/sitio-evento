<!-- Condicionamos que exista la variable $_POST['submit']  -->
<?php if(isset($_POST['submit'])):

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $regalo = $_POST['regalo'];
        $total = $_POST['total_pedido'];
        $fecha = date('Y-m-d H:i:s');   
        

        // Importamos el archivo funciones.php
        include_once 'includes/funciones/funciones.php';

        // Pedidos
        $boletos = $_POST['boletos'];
        $camisas = $_POST['pedido_camisas'];
        $etiquetas = $_POST['pedido_etiquetas'];
        // Llamamos a la funcion productos_json() y le pasamos 3 parametros
        $pedido = productos_json($boletos, $camisas, $etiquetas);

        // Eventos
        $eventos = $_POST['registro'];
        // Llamamos a la funcion eventos_json() y le pasamos 1 parametro
        $registro = eventos_json($eventos);
    
        // Insertamos datos a la Base de Datos utilizando PREPARED STATEMENTS.
        // Prepared Statements: Los Prepared Statements ofrecen dos ventajas principales.
        // 1) La sobrecarga de compilar la declaración se incurre solo una vez, aunque la instrucción se ejecuta varias veces.
        // 2) Los Prepared Statements son resistentes frente a la inyección de SQL.
        try{
            require_once('includes/funciones/bd_conexion.php');
            
            //PASO 1:
            // A la conexion "$conn" le asignamos una funcion llamada "prepare()" y de esta forma preparamos los campos que se van a rellenar, y en el Value colocamos "?" por cada campo que se va a cargar.
            // stmt = Statements
            $stmt = $conn->prepare("INSERT INTO registrados(nombre_registrado, apellido_registrado, email_registrado, fecha_registro, pases_articulos, talleres_registrados, regalo, total_pagado) VALUES(?,?,?,?,?,?,?,?)");

            // PASO 2:
            // A la variable de Statements "$stmt" le asignamos una funcion llamada "bind_param()" y como primer parametro le pasamos "s"(string) o "i"(integer) por cada campo que se cargará y su tipo de dato, y como segundo parametro se pasan las variables que se cargaran en el INSERT pero se tiene que respetar las "s" y "i" en el orden que los agregamos.
            $stmt->bind_param("ssssssis", $nombre, $apellido, $email, $fecha, $pedido, $registro, $regalo, $total);

            // PASO 3:
            // Ejecutamos la consulta
            $stmt->execute();

            // PASO 4:
            // Cerramos el Statements y la Conexion.
            $stmt->close();
            $conn->close();

            //Header('Location: path de un sitio web'): Con esta funcion relocalicamos a un sitio web
            // En este caso nos relocalicamos a la misma pagina con la extencion "?exitoso=1", para que cuando se recarge la pagina se borren todos los datos del formulario y no se vuelvan a reenviar a la base de datos.
            // Pero para que la funcion Header() funcione tenemos que ubicar todo el codigo antes del <header>, es decir no se tiene que enviar ninguna etiqueta HTML ni nada, antes de esta funcion sino no va a funcionar.
            header('Location: validar_registro.php?exitoso=1');
        } catch(Exeption $e){
            $error = $e->getMessage();

        }

    endif;
  
?>

<!-- Importamos el archivo header.php  -->
<?php include_once 'includes/templates/header.php';?>

<section class="seccion contenedor">

    <h2>Resumen Registro</h2>

    

</section>

<!-- Importamos el archivo footer.php -->
<?php include_once 'includes/templates/footer.php';?>