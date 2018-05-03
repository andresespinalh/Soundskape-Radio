<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$data = json_decode(file_get_contents("php://input"));


$id_genero = $data->id_genero;

$conn = new mysqli("localhost","root","","radio");



$result = $conn->query("SELECT b.id_cancion as 'id_cancion',titulo,duracion,nombre_artistico FROM artista_por_cancion a, cancion b,artista c WHERE (a.id_cancion=b.id_cancion) and (a.id_artista=c.id_artista) and (id_genero='$id_genero')");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"id_cancion":"'  . $rs["id_cancion"] . '",';
    $outp .= '"titulo":"'  . $rs["titulo"] . '",';
    $outp .= '"duracion":"'  . $rs["duracion"] . '",';
    $outp .= '"nombre_artistico":"'   . $rs["nombre_artistico"]    . '"}';
}
$outp ='{"records":['.$outp.']}';
echo $outp;

?>