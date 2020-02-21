<?php
// Script para verifica si el usuario esta logeado, en caso de que no, lo redirige al login.php
function usuario_autenticado(){
    if(!revisar_usuario()){
        //Redirige al login.php
        header('Location:login.php');
        exit();
    }
}

function revisar_usuario(){
    //Verifica que exista la variabel "$_SESSION['usuario']"
    return isset($_SESSION['usuario']);
}

session_start();
usuario_autenticado();