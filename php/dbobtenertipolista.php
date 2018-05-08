<?php
include('dbconexion.php');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$conexion = conectar();
$data = json_decode(file_get_contents("php://input"));






$result = $conexion->query("SELECT * FROM tipo_lista_reproduccion"); 


$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {//Recibe con los resultados de la consulta todos los nombres de ciudades 
   	$tipo_lista_reproduccion=$rs['tipo_lista_reproduccion']; 	
	
}
$outp="";
 
 $outp .= '{"tipo_lista_reproduccion":"'   . $tipo_lista_reproduccion        . '"}';
$outp =utf8_decode('{"records":['.$outp.']}'); //Guarda en formato json para el envio al formulario

$conexion->close();

echo $outp;
?>