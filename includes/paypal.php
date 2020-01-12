<?php

// 1. Carga automática del paquete SDK. Esto incluirá todos los archivos y clases del "autoload"
// Ejemplo basado en la instalacion con "composer" 
require  __DIR__  .'/paypal/autoload.php';
//En el caso que la instalación sea con la descarga directa:
// requiera __DIR__. '/PayPal-PHP-SDK/autoload.php';

define('URL_SITIO', 'http://localhost/sitio-eventos/');

$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(       
        'AR5DJXZBUqEmmWYy-2NfxmMEeWmwSFV04tHelXajN6cWp1OYhlspXYGft9UAnhqqMRDmNrmx-THKs-I_', // ClientID
        'EPj9aBlofQccxB7bx6hym8TKXCVmw-c4jqPKQQPsswa2mofuzMyV90hdK6XzeoFCXp9oQkjsOu94RIDU'  // ClientSecret
    )
);

// var_dump($apiContext);