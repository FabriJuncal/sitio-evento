<?php

// Pasamos por referencias los datos para que se mantengan
function productos_json(&$boletos, &$camisas = 0, &$etiquetas = 0){

    // Creamos un array asociativo
    $dia = array(0 => 'un_dia', 1 => 'pase_completo', 2 => 'pase_2dias');
    
    unset($boletos['pase_dia']['precio']);
    unset($boletos['pase_dosdias']['precio']);
    unset($boletos['pase_completo']['precio']);

    // array_combine():  Crea una matriz usando una matriz para las claves y otra para sus valores.
    // Parametros: array_combine($matris para las llaves, $matris para los valores)
    // En este caso combinamos las dos matrices y utilizamos los valores de la matriz $dia para las llaves y los valores de la matriz $boletos para los valores
    $total_boletos = array_combine($dia, $boletos);

    // Cargamos las Camisas en el array $total_boletos
    // Transformamos a entero la variable $camisas y la utilizamos para hacer una condicion
    // Nos aseguramos que se carguen los datos solo si es mayor a cero
    if((int) $camisas > 0):
        // Tranformamos a entero la variable $camisas y le asignamos a una matriz asociativa
        $total_boletos['camisas'] = (int) $camisas;   
    endif;

    // Cargamos las Etiquetas en el array $total_boletos
    // Transformamos a entero la variable $etiquetas y la utilizamos para hacer una condicion
    // Nos aseguramos que se carguen los datos solo si es mayor a cero
    if((int) $etiquetas > 0):
        // Tranformamos a entero la variable $etiquetas y le asignamos a una matriz asociativa
        $total_boletos['etiquetas'] = (int) $etiquetas;   
    endif;



    // json_encode(): Retorna en formato JSON el parametro que le pasemos   
    return json_encode($total_boletos);


}

// Pasamos por referencias los datos para que se mantengan
function eventos_json(&$eventos){
    $eventos_json = array();

    foreach ($eventos as $evento){
        // Agregamos un corchete vacio para que rellene el array con todos los datos y no solo con uno
        $eventos_json['eventos'][] = $evento;
    }

    // json_encode(): Retorna en formato JSON el parametro que le pasemos   
    return json_encode($eventos_json);
}