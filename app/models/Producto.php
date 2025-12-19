<?php
require_once 'Conexion.php';
class Producto extends Conexion{
//Este atributo contendra la conexion que iniciamos en class Producto extends Conexion
private $pdo;

public function __construct(){
  //La conexion asigna el acceso a $this ->pdo
  $this->pdo = parent::getConexion();
  //tomamos parent que tiene almacenado a conexion junto a get conection y lo
  //guardamos en pdo
}
public function listar(){
try{
  // 1 Crear mi consulta sql
$sql = "
SELECT 
id,classificacion, marca, descripcion, garantia, ingreso, cantidad
 FROM productos
 ORDER BY id DESC";
//2 Enviar la consulta preparada a PDO
$consulta = $this->pdo->prepare($sql);

//3 Ejecutar la consulta}
$consulta->execute();

//4 Entregar resultado
//fetchAll (Coleccion de arreglos)
//PDO::FETCH_ASSOC (los valores son asociativos)
return $consulta->fetchAll(PDO::FETCH_ASSOC);
}
catch(Exception $e){
  return [];
}
}


public function registrar($registro = []):int{
  try{
    //los comodines, poseen indices (arreglos)
    $sql="
    INSERT INTO productos 
    (classificacion, marca, descripcion, garantia, ingreso, cantidad) VALUES
     (?,?,?,?,?,?)
     ";
//2 Enviar la consulta preparada a PDO
$consulta = $this->pdo->prepare($sql);
//3 La consulta lleva comodines, pasamos los datos en execute()
$consulta->execute(
array(
$registro ['classificacion'],
$registro ['marca'],
$registro ['descripcion'],
$registro ['garantia'],
$registro ['ingreso'],
$registro ['cantidad']

)

);
//¡Cuantos registros fueron afectados
return $consulta->rowCount();


  }
  catch(Exception $e){
    //Se optiene cuando salio mal
    return -1; 

  }

}

public function eliminar($id):int{
  try{
    $sql="DELETE FROM productos WHERE id=?";

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

public function actualizar($registro = []):int{ 
  try{
    //los comodines, poseen indices (arreglos)
    $sql="
    UPDATE productos SET
    classificacion = ?,
    marca = ?,
    descripcion = ?,
    garantia = ?,
    ingreso = ?,
    cantidad = ?,
    updated = NOW()
    WHERE id = ?
";
//2 Enviar la consulta preparada a PDO
$consulta = $this->pdo->prepare($sql);
//3 La consulta lleva comodines, pasamos los datos en execute()
$consulta->execute(
array(
$registro ['classificacion'],
$registro ['marca'],
$registro ['descripcion'],
$registro ['garantia'],
$registro ['ingreso'],
$registro ['cantidad'],
$registro ['id']
)

);
//retornar la Primary Key generada
return $this->pdo->lastInsertId();


  }
  catch(Exception $e){
    return -1; 

  }
  

}

public function buscar($registros = []):array{ 
try{
  // 1 Crear mi consulta sql
$sql = " SELECT * FROM productos WHERE id = ?";
//2 Enviar la consulta preparada a PDO
$consulta = $this->pdo->prepare($sql);

//3 Ejecutar la consulta}
$consulta->execute(
  array($registros)
);

//4 Entregar resultado
//fetchAll (Coleccion de arreglos)
//PDO::FETCH_ASSOC (los valores son asociativos)
return $consulta->fetchAll(PDO::FETCH_ASSOC);
}
catch(Exception $e){
  return [];
}
  

}
}