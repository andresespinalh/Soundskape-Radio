<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    $conn = new mysqli("localhost","root","","radio");

    $result = $conn->query("SELECT ciudad 
                            FROM ciudad 
                            ORDER BY ciudad ASC");

    $outp = "";
    while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
        if ($outp != "") {$outp .= ",";}
        $outp .= '{"ciudad":"'   . $rs["ciudad"]        . '"}';
    }
    $outp =utf8_decode('{"records":['.$outp.']}');

    $conn->close();

    echo($outp);
?>