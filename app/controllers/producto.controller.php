<?php

//necesita del modelo para poder responder...
require_once '../models/Producto.php';
$producto = new Producto();

//¿Que operacion desea realizar el usuario?
//consulta, registro, actualizar, eliminar, buscar ¿?

//isset es una funcion que determina si un ibjeto existe o fue definido
//$_POST[''] permite interactuar con valores que envia la vista a traves de un metodo POST
if (isset($_POST ['operacion'])){

    //El usuario nos envio una tarea
    switch($_POST['operacion']){
        case 'listar':
            //codigo para listar
            $registros = $producto->listar();
            //JSON : Javascript Object Notation
            //Es un mecanismo de intercambio de datos entre el servidor y el cliente
            echo json_decode($registros);
            break;
        case 'registrar':
            //codigo para registrar
            break;
        case 'actualizar':
            //codigo para actualizar
            break;
        case 'eliminar':
            //codigo para eliminar
            break;
    }
}