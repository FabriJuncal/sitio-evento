<?php 
include_once 'includes/templates/header.php';

use PayPal\Rest\ApiContext;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Payment;
require 'includes/paypal.php';
?>

  <section class="seccion contenedor">
      <div class="formulario">
            <h2>Pagos con Paypal</h2>
            <?php
            $paymentID = $_GET["paymentId"];
            $id_pago = $_GET['id_pago'];

            // Peticiones a REST API (PAYPAL)
            // No instanciamos la clase "Payment". En este caso se accede de manera estatica a los metodos con "::"
            $pago = Payment::get($paymentID, $apiContext); // Accedemos a PayPal
            $execution = new PaymentExecution();
            $execution->setPayerId($_GET['PayerID']); // Enviamos el ID del pago

            // Informacion de la Transacción
            $resultado = $pago->execute($execution, $apiContext); // Ejecutamos la funcion y obtenemos los datos de la transacción            
            $respuesta = $resultado->transactions[0]->related_resources[0]->sale->state;
                     
            if($respuesta == "completed"){ // Se concreto el pago
            
                echo "<div class='resultado correcto'>";
                echo "<p style='font-size: 1.5rem;'>¡El pago se relizo con exito!</p>";
                echo "<p>Codigo de la transaccion:</p>";
                echo "<p>{$paymentID}</p>";
                echo "</div>";
                // Actualizamos el campo "pagado" en el caso que se termine de realizar el pago
                require_once('includes/funciones/bd_conexion.php');
                $smtp = $conn->prepare('UPDATE registrados SET pagado = ? WHERE ID_Registrado = ?');
                $pagado = 1;
                $smtp->bind_param('ii', $pagado, $id_pago);
                $smtp->execute();
                $smtp->close();
                $conn->close();
                      
            }else{ // Se cancelo el pago
                echo "<div class='resultado error'>";
                echo "<p style='font-size: 1.5rem;'>¡El pago se cancelo!<p>";
                echo "</div>";
            }
            ?>
      </div>
  </section>

<!-- 10ma SECCION (Footer) -->
<?php include_once 'includes/templates/footer.php';?>