<?php
//1. Acceder a la clase conexion
require_once 'Conexion.php';
//2 El provedor heredara las funcionalidad de la clase conexion
class Proveedor extends Conexion{
//3. Creamos un atributo que guardara la conexion
private $pdo;

//4. En el constructor, guardamos la conexion activa
public function __construct(){
  //tenemos que usar $this porque pdo es un atributo de la clase
  //Despues de llamar a pdo usamos parent para acceder ala conexion de la clase
  $this->pdo = parent::getConexion();
}
public function listar(){
  try{
    $sql = "
    SELECT
    id,razonsocial,ruc,telefono,origen,contacto,confianza
    FROM proveedores
    ORDER BY id DESC
    ";
    $consulta = $this->pdo->prepare($sql);

    $consulta->execute();

    return $consulta->fetchAll(PDO::FETCH_ASSOC);
  }
  catch(Exception $e){
    return [];
  }

}
public function registrar($registro = []):int{
  try{
    $sql="
    INSERT INTO proveedores
    (razonsocial, ruc, telefono, origen, contacto, confianza) VALUES
    (?,?,?,?,?,?)
    ";
    $consulta = $this->pdo->prepare($sql);
    $consulta->execute(
      array(
        $registro['razonsocial'],
        $registro['ruc'],
        $registro['telefono'],
        $registro['origen'],
        $registro['contacto'],
        $registro['confianza']
      )
    );
    return $consulta->rowCount();
  }
  catch(Exception $e){
    return -1;
  }

}
  
public function actualizar($registro = []):int{
  try{
    $sql="
    UPDATE proveedores SET
    razonsocial = ?,
    ruc = ?,
    telefono = ?,
    origen = ?,
    contacto = ?,
    confianza = ?,
    updated = NOW()
    WHERE id = ?
    ";
    $consulta = $this->pdo->prepare($sql);
    $consulta->execute(
      array(
        $registro['razonsocial'],
        $registro['ruc'],
        $registro['telefono'],
        $registro['origen'],
        $registro['contacto'],
        $registro['confianza'],
        $registro['id']
      )
    );
    return $consulta->rowCount();
  }
  catch(Exception $e){
    return -1;
  }

}
public function eliminar($id){
    try{
    $sql="DELETE FROM proveedores WHERE id=?";

$consulta = $this->pdo->prepare($sql);
//El execute() esta vacio cuando no utilizamos comodines
$consulta->execute(
  array($id)
);

//Devolvemos un numero si se pudo o no borrar
//retorna la cantidad de filas afectadas
  return $consulta->rowCount();
  }
  catch(Exception $e){
    return -1;
  }

}


}