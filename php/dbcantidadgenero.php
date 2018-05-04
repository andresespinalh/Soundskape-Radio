<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    $conn = new mysqli("localhost","root","","radio");
    
    $result = $conn->query("SELECT count(*) as 'cantidad', genero,b.id_genero  as 'id_genero' 
                            FROM cancion a,genero b 
                            WHERE a.id_genero=b.id_genero 
                            GROUP BY a.id_genero");

    $outp = "";
    while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
        if ($outp != "") {$outp .= ",";}
        $outp .= '{"cantidad":"'  . $rs["cantidad"] . '",';
        $outp .= '"genero":"'  . $rs["genero"] . '",';
        $outp .= '"id_genero":"'   . $rs["id_genero"]    . '"}';
    }
    $outp ='{"records":['.$outp.']}';
    echo $outp;

?>