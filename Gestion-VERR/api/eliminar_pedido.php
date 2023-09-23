<?php
include('../config/conexion.php');
$response = new stdClass();

	$codped = $_POST['codped'];

	$sql = "UPDATE pedido SET estado = 0
	WHERE codped = $codped";
	$result = mysqli_query($con, $sql);
	if($result==true){
		$response->state = true;
		$response->detail = "Reload";
	}else{
		$response->state = false;
		$response->detail = "No se actualizó el estado del pedido";
	}

echo json_encode($response);