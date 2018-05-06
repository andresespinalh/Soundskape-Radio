<?php
include('dbconexion.php');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conexion = conectar();



$result = $conexion->query("SELECT ciudad FROM ciudad ORDER BY ciudad ASC"); //Consulta que obtiene todos los nombres de las ciudades

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {//Recibe con los resultados de la consulta todos los nombres de ciudades 
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"ciudad":"'   . $rs["ciudad"]        . '"}';
}
$outp =utf8_decode('{"records":['.$outp.']}'); //Guarda en formato json para el envio al formulario

$conexion->close();

echo $outp;
?>