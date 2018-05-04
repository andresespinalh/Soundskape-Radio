<?php 
$data = json_decode(file_get_contents("php://input"));


$namesurname = $data->namesurname;
$password = $data->password;



$con = new mysqli("localhost","root","","radio");




$result = $con->query( "SELECT * FROM usuario WHERE alias='$namesurname'");



while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
	$realpassword=$rs['contrasenia'];
	
}

$realpassword = base64_decode($realpassword);



if($realpassword==$password){
	$outp="";
 $outp .= '{"alias":"'   . $namesurname        . '"}';
 $outp =utf8_decode('{"records":['.$outp.']}');


echo $outp;

}



?>