<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$data = json_decode(file_get_contents("php://input"));


$id_genero = $data->id_genero;

$conn = new mysqli("localhost","root","","radio");

$rows = array();

$result = $conn->query("SELECT b.id_cancion as 'id_cancion',titulo,duracion,nombre_artistico,direccion FROM artista_por_cancion a, cancion b,artista c WHERE (a.id_cancion=b.id_cancion) and (a.id_artista=c.id_artista) and (id_genero='$id_genero') ORDER BY nombre_artistico ASC");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
	
    

   

    if ($outp != "") {$outp .= ",";}
    $rs["nombre_artistico"] = preg_replace("/[^a-zA-Z0-9_.'()]/", '', $rs["nombre_artistico"]);
    $rs["titulo"] = preg_replace("/[^a-zA-Z0-9_.'()]/", '', $rs["titulo"]);
    $rs["direccion"] = preg_replace("/[^a-zA-Z0-9_'()]/", '', $rs["direccion"]);

    $outp .= '{"id_cancion":"'  . $rs["id_cancion"] . '",';
    $outp .= '"titulo":"'  . $rs["titulo"] . '",';
    $outp .= '"duracion":"'  . $rs["duracion"] . '",';
    $outp .= '"direccion":"'  . $rs["direccion"] . '",';
    $outp .= '"nombre_artistico":"'   . $rs["nombre_artistico"]    . '"}';
}


$outp ='{"records":['.$outp.']}';
echo $outp;
?>