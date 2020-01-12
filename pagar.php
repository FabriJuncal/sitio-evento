<?php

if(!isset($_POST['submit'])){
    exit("Hubo un error");
}

// Utilizamos el Metodo "namespace" para importar las clases
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;

require_once 'includes/paypal.php';

if(isset($_POST['submit'])){
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $regalo = $_POST['regalo'];
    $total = $_POST['total_pedido'];
    $fecha = date('Y-m-d H:i:s');
    // Pedidos
    $boletos = $_POST['boletos'];
    $numero_boletos = $boletos;
    $camisas = $_POST['pedido_extra']['camisas']['cantidad'];

    $pedidoExtra = $_POST['pedido_extra'];
    $precioCamisa = $_POST['pedido_extra']['camisas']['precio'];
    $etiquetas = $_POST['pedido_extra']['etiquetas']['cantidad'];
    $precioEtiqueta = $_POST['pedido_extra']['etiquetas']['precio'];

    include_once 'includes/funciones/funciones.php';
    $pedido = productos_json($boletos, $camisas, $etiquetas);
    $eventos = $_POST['registro'];
    $registro = eventos_json($eventos);

    // echo '<pre>';
    // print_r($numero_boletos);
    // echo '</pre>';
    // exit;

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

            // Obtenemos el ID que se inserta en la base de dtos y la declaramos a una variable
            $ID_registro = $stmt->insert_id;

            // PASO 4:
            // Cerramos el Statements y la Conexion.
            $stmt->close();
            $conn->close();

            //Header('Location: path de un sitio web'): Con esta funcion relocalicamos a un sitio web
            // En este caso nos relocalicamos a la misma pagina con la extencion "?exitoso=1", para que cuando se recarge la pagina se borren todos los datos del formulario y no se vuelvan a reenviar a la base de datos.
            // Pero para que la funcion Header() funcione tenemos que ubicar todo el codigo antes del <header>, es decir no se tiene que enviar ninguna etiqueta HTML ni nada, antes de esta funcion sino no va a funcionar.
            // header('Location: validar_registro.php?exitoso=1');
        } catch(Exeption $e){
            $error = $e->getMessage();

        }
}

// FORMA DE PAGO
$compra = new Payer();
$compra->setPaymentMethod('paypal');  // setPaymentMethod(): Insertar el metodo de pago
                                      // getPaymentMethod(): Obtener el metodo de pago

// MODO ESTATICO
// $articulo = new Item();
// $articulo->setName($producto) 
//          ->setCurrency('USD') 
//          ->setQuantity(1)     
//          ->setPrice($precio); 

// DATOS DEL ARTICULO
// MODO DINAMICO
$i = 0;
$arreglo_pedido = array();
foreach($numero_boletos as $key => $value){
    if((int) $value['cantidad'] > 0){
        // Dependiendo el tipo de pase que se obtenga, le asignamos la cadena a la variable       
        $tipo_pase = (($key == 'pase_dia')? 'Pase un día'
                    :(($key == 'pase_dosdias')? 'Pase dos días'
                    :(($key == 'pase_completo') ? 'Pase completo'
                    :null)));
       
        //Declaramos Variables Dinamicas
        ${"articulo$i"} = new Item();
        $arreglo_pedido[] = ${"articulo$i"};
        ${"articulo$i"}->setName('Pase: ' . $tipo_pase)               //setName():Insertar Nombre Articulo.
                       ->setCurrency('USD')                     //setCurrency():Insertar Tipo de Moneda.   Codigos de Monedas: https://developer.paypal.com/docs/api/reference/currency-codes/
                       ->setQuantity((int) $value['cantidad'])  //setQuantity():Insertar Cantidad.
                       ->setPrice((int) $value['precio']);      //setPrice():Insertar Precio
        $i++;   
    }
}

foreach($pedidoExtra as $key => $value){
    if((int) $value['cantidad'] > 0){
        if($key == 'camisas'){
            $precio = (float) $value['precio'] * .93;
        }else{
            $precio = (int) $value['precio'];
        }
        //Declaramos Variables Dinamicas
        ${"articulo$i"} = new Item();
        $arreglo_pedido[] = ${"articulo$i"};
        ${"articulo$i"}->setName('Extras: ' . $key)               //setName():Insertar Nombre Articulo.
                       ->setCurrency('USD')                     //setCurrency():Insertar Tipo de Moneda.   Codigos de Monedas: https://developer.paypal.com/docs/api/reference/currency-codes/
                       ->setQuantity((int) $value['cantidad'])  //setQuantity():Insertar Cantidad.
                       ->setPrice($precio);      //setPrice():Insertar Precio
        $i++;   
    }
}


// LISTA DE ARTICULOS
$listaArticulos = new ItemList();
$listaArticulos->setItems($arreglo_pedido); //setItems(): Insertar Articulos a la List de Articulos

// DATOS TRANSACCION
$cantidad = new Amount();
$cantidad->setCurrency('USD')   //setCurrency():Insertar Tipo de Moneda
         ->setTotal($total);    //setTotal():Insertar Total de la transaccion


// DEFINICION DEL CONTRATO - PARA QUE ES EL PAGO Y QUIEN LO ESTA REALIZANDO
$transaccion = new Transaction();
$transaccion->setAmount($cantidad) //setAmount(): Cantidad recaudada
            ->setItemList($listaArticulos)//setItemList(): Lista de artículos que se pagan
            ->setDescription('Pago GLDWEBCAMP')//setDescription(): Descripción de lo que se paga
            ->setInvoiceNumber($ID_registro);//setInvoiceNumber(): número de factura para rastrear el pago
                                         

// CONJUNTO DE URL DE REDIRECCIONAMIENTO QUE PROPORCIONA SOLO PARA PAGOS BASADOS EN PAYPAL.
$redireccionar = new RedirectUrls();
$redireccionar->setReturnUrl(URL_SITIO."pago_finalizado.php?exito=true&id_pago={$ID_registro}")//setReturnUrl(): URL a la que se redirigiría al pagador después de aprobar el pago.
              ->setCancelUrl(URL_SITIO."pago_finalizado.php?exito=false&id_pago={$ID_registro}");//setCancelUrl(): URL a la que se redirigiría al pagador después de cancelar el pago

$pago = new Payment();
$pago->setIntent("sale")//setIntent(): Intento de pago ->  Valores válidos: ["sale", "authorize", "order"]
     ->setPayer($compra)//setPayer(): Origen de los fondos para el pago representado por una cuenta PayPal o una tarjeta de crédito directa
     ->setRedirectUrls($redireccionar)//setRedirectUrls(): Conjunto de URL de redireccionamiento que proporciona solo para pagos basados en PayPal
     ->setTransactions(array($transaccion));//setTransactions(): Detalles de la transacción, incluidos el monto y los detalles del artículo

try{
    $pago->create($apiContext); // Se concreta el pago
}catch (PayPal\Exception\PayPalConnectionException $pce){
    echo "<pre>";
    die(print_r(json_decode($pce->getData()))); // En el caso que ocurra un error, se lo imprime por pantalla
}

$aprobado = $pago->getApprovalLink(); // Cargamos el link del sitio de Paypal en una variable

// ADVERTENCIA: para que nos redirecione no debe nada que imprima HTML, sino no funciona
header("Location: {$aprobado}"); // Redirecciona al sitio de Paypal








