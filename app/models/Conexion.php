<?php
//todos los modelos (logica / motor de la APP) requieren acceder
//a la base de datos, esta clase, brindara este acceso
class Conexion{
  //Atributos
  private $servidor ="localhost";
  private $puerto = "3306";
  private $baseDatos = "tiendaperu";
  private $usuario = "root";
  private $clave = "";


  public function getConexion(){
    //manejador de excepciones/errores
    try{
      
    }
    catch(Exception $e){
      //Cuando se sucito un error al conectarme al ssitema
      die($e->getMessage());

    }
  }
}