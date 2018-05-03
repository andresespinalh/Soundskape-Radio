<?php 
$data = json_decode(file_get_contents("php://input"));


$namesurname = $data->namesurname;
$password = $data->password;



$con = mysql_connect("localhost","root","");
mysql_select_db("database_name");




$sql = "Script sql goes here";

$result = mysql_query($sql);



$con->close();



?>