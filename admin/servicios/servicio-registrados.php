<?php

// echo "<pre>";
// die(print_r($_REQUEST));

// Declaramos la variable para verificar la ruta desde donde estamos posicionados
// y poder controlar las importaciones de los archivos de conexion a la base de datos
$ruta = pathinfo(__DIR__);

include_once '../funciones/sesiones.php';
include_once '../funciones/funciones.php';


$sql = "SELECT fecha_registro,
               COUNT(*) AS cantRegistrados, 
                (SELECT COUNT(*)
                FROM registrados rr 
                WHERE pagado = 1 and DATE(rr.fecha_registro) = DATE(r.fecha_registro)) AS cantPagados,
                (SELECT SUM(total_pagado)
                FROM registrados rr 
                WHERE pagado = 1 and DATE(rr.fecha_registro) = DATE(r.fecha_registro)) AS ganancia
        FROM registrados r 
        GROUP BY DATE(fecha_registro) 
        ORDER BY fecha_registro";

$resultado = $conn->query($sql);


$arreglo_registro = array();

while ( $registro_dia = $resultado->fetch_assoc()){

    $fecha = $registro_dia['fecha_registro'];
    $registro['fecha'] = date('d-m-Y', strtotime($fecha));
    $registro['cantidad'] = $registro_dia['cantRegistrados'];
    $registro['pagados'] = $registro_dia['cantPagados'];
    $registro['ganancia'] = $registro_dia['ganancia'];


    $arreglo_registro[] = $registro;
}



echo json_encode($arreglo_registro);
