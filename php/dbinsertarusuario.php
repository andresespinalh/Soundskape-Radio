<?php 
	$data = json_decode(file_get_contents("php://input"));

	$namesurname = $data->namesurname;
	$password = $data->password;

	$email = $data->email;
	$borndate = $data->borndate;
	$city = $data->city;
	$firstname = $data->firstname;
	$secondname = $data->secondname;
	$firstlastname = $data->firstlastname;
	$secondlastname = $data->secondlastname;

	$con = mysql_connect("localhost","root","");
	mysql_select_db("radio");

	$conn = new mysqli("localhost","root","","radio");
	try{

	$result = $conn->query( "SELECT id_ciudad 
								FROM ciudad 
								WHERE ciudad='$city'");

	while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
		$cityid=$rs['id_ciudad'];
	}

	$sql = "INSERT INTO persona(primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, correo_electronico, fecha_nacimiento, id_ciudad) 
			VALUES ('$firstname','$secondname','$firstlastname','$secondlastname','$email','$borndate','$cityid')";

	$result = mysql_query($sql);
	}catch(Exception $e){
		echo $e+$cityid;
	}

	$password=base64_decode($password, true);
	$now = date('Y-m-d');

	$result1 = $conn->query( "SELECT id_persona 
								FROM persona 
								ORDER BY id_persona ASC");

	while($rs1 = $result1->fetch_array(MYSQLI_ASSOC)) {
		$personid=$rs1['id_persona'];
	}

	$sql1="INSERT INTO usuario( id_usuario,alias,contrasenia, fecha_ingreso, id_tipo_usuario, id_persona) 
					VALUES ('$namesurname','$namesurname','$password','$now',1,'$personid')";

	$result2 = mysql_query($sql1);
?>